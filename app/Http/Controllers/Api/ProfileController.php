<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileV2Request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // get profil
        $user = $request->user();
        $profil = collect();

        if ($user->type === User::LECTURER) {
            $profil = $user->load(['lecturer' => function ($query) {
                $query->select('lecturers.*', 'departments.name as department_name')
                    ->join('departments', 'lecturers.department_id', 'departments.id');
            }])->lecturer;
        } elseif ($user->type === User::STUDENT) {
            $profil = $user->load(['student' => function ($query) {
                $query->select('students.*', 'departments.name as department_name')
                    ->join('departments', 'students.department_id', 'departments.id');
            }])->student;
        } elseif ($user->type === User::STAFF) {
            $profil = $user->load(['staff' => function ($query) {
                $query->select('staff.*', 'departments.name as department_name')
                    ->join('departments', 'staff.department_id', 'departments.id');
            }])->staff;
        }

        $profil->username = $user->username;
        $profil->email = $user->email;

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $profil,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $civitas = $user->civitas;
        if ($civitas != null) {
            $civitas->phone = request('phone');
            $civitas->email = request('email');
            $civitas->nik = request('nik');
            $civitas->address = request('address');
            $civitas->birthday = request('birthday');
            $civitas->birthplace = request('birthplace');
            switch ($user->type) {
                case User::STUDENT:
                    $civitas->year = request('year');
                    break;
                case User::LECTURER:
                    $civitas->nim = request('nidn');
                    $civitas->karpeg = request('karpeg');
                    break;
                case User::STAFF:
                    $civitas->karpeg = request('karpeg');
                    break;
            }
            $civitas->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengupdate profile pengguna',
        ]);
    }

    public function mobileToken(Request $request)
    {
        $user = $request->user();
        if ($user != null) {
            $user->mobile_token = request('token');
            if ($user->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Token Aplikasi mobile telah didaftarkan',
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Gagal mendaftarkan token',
                ]);
            }
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'User tidak ditemukan',
        ], 404);
    }

    public function updateV2(UpdateProfileV2Request $request)
    {
        $data = $request->validated();
        $user = $request->user();
        $civitas = $request->user()->civitas;
        $path = null;

        // cek email
        $isExist = User::where('email', $data['email'])
            ->where('id', '!=', $request->user()->id)
            ->first();

        if ($isExist) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Email sudah digunakan',
            ], 400);
        }

        // update akun
        $user->email = $data['email'];
        $user->save();

        // cek data profil civitas
        if ($civitas !== null) {
            // update profile
            $civitas->nik = $data['nik'] ?? null;
            $civitas->birthday = $data['birthday'] ?? null;
            $civitas->birthplace = $data['birthplace'] ? ucwords(strtolower($data['birthplace'])) : null;
            $civitas->phone = $data['phone'] ?? null;
            $civitas->address = $data['address'] ?? null;
            $civitas->gender = in_array($data['gender'], ['M', 'F']) ? $data['gender'] : null;
            $civitas->marital_status = $data['marital_status'] ?? null;
            $civitas->religion = $data['religion'] ?? null;

            switch ($request->user()->type) {
                case User::LECTURER:
                    $civitas->nidn = $data['nidn'] ?? null;
                    $civitas->karpeg = $data['karpeg'] ?? null;
                    $path = Config::get('central.path.lecturer_photo');
                    break;
                case User::STAFF:
                    $civitas->karpeg = $data['karpeg'] ?? null;
                    $path = Config::get('central.path.staff_photo');
                    break;
                case User::STUDENT:
                    $path = Config::get('central.path.student_photo');
                    break;
            }

            // cek apakah ada foto yang diupload
            if (array_key_exists('photo', $data)) {
                // jika ada foto, hapus dulu
                if ($civitas->photo) {
                    Storage::disk('public')->delete($civitas->photo);
                }

                // simpan foto
                $filePath = Storage::disk('public')->put($path, $data['photo']);
                $civitas->photo = $filePath;
            }

            $civitas->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui',
            'data' => [
                'email' => $user->email,
                ...$civitas->toArray(),
            ],
        ]);
    }
}
