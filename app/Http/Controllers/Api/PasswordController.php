<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function update(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::find(Auth::user()->id);

        if ($user) {
            if (Hash::check($data['password_current'], $user->password)) {
                $user->password = Hash::make($data['password_new']);
                if ($user->save()) {
                    // logout
                    Auth::user()->tokens()->delete();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Password berhasil diperbarui',
                        'user' => $user,
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Password Lama Salah',
                ], 403);
            }
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal Merubah Password',
        ], 403);
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('email.forgetpassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Mengirimkan Email',
        ], 200);
    }
}
