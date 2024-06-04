<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $email = $data["email"];
        $password = $data["password"];
        $remember_me = $data["remember_me"] ?? null;

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Kredensial tidak valid'
            ], 400);
        }

        // create token
        $token = null;
        if ($remember_me) {
            $token = $user->createToken('API_TOKEN');
        } else {
            $token = $user->createToken('API_TOKEN', ['*'], Carbon::now()->addHours(2));
        }

        // get profil
        $profile = collect();
        if ($user->type === User::LECTURER) {
            $profile = $user->load(['lecturer' => function ($query) {
                $query->select("lecturers.*", "departments.name as department_name")
                    ->join("departments", "lecturers.department_id", "departments.id");
            }])->lecturer;
        } elseif ($user->type === User::STUDENT) {
            $profile = $user->load(['student' => function ($query) {
                $query->select("students.*", "departments.name as department_name")
                    ->join("departments", "students.department_id", "departments.id");
            }])->student;
        } elseif ($user->type === User::STAFF) {
            $profile = $user->load(['staff' => function ($query) {
                $query->select("staff.*", "departments.name as department_name")
                    ->join("departments", "staff.department_id", "departments.id");
            }])->staff;
        }

        $profile->username = $user->username;
        $profile->email = $user->email;

        // define response data
        $data = [
            "authorization" => [
                "token" => $token->plainTextToken,
                "type" => "Bearer",
                "expires_at" => strtotime($token->accessToken->expires_at) * 1000,
            ],
            "profile" => $profile,
            "permissions" => $user->getAllPermissions(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => $data
        ]);
    }

    public function refresh(Request $request)
    {
//        $token = auth("api")->refresh();
         auth()->user()->tokens()->delete();
         $token = auth()->user()->createToken('API_TOKEN',['*'],Carbon::now()->addHours(2))->plainTextToken;

        return response()->json([
            'status' => 'success',
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => 7200000,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logout'
        ]);
    }

    public function unauthorized(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Tidak terautentikasi'
        ], 401);
    }

    public function forbidden(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Akses tidak diizinkan'
        ], 403);
    }

    public function history()
    {
        $logins = auth()->user()
            ->logins()
            ->orderBy('login_at', 'desc')
            ->paginate(100);

        $user = auth()->user();

        return response()->json($logins);
    }
}
