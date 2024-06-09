<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show($email)
    {
        try {
            $user = User::where('email', $email)->first();

            if (is_null($user)) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found.",
                ], 404);
            }

            return response()->json([
                "status" => true,
                "data" => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 400);
        }
    }
    public function showUsername($username)
    {
        try {
            $user = User::where('username', $username)->first();

            if (is_null($user)) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found.",
                ], 404);
            }

            return response()->json([
                "status" => true,
                "data" => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required|max:60',
                'email' => 'required|email:rfc,dns|unique:users',
                'password' => 'required',
                'tanggalLahir' => 'required',
                'noTelp' => 'required',
                'gender' => 'required',
            ]);

            $user = User::find($id);

            if (!$user) throw new \Exception("User tidak ditemukan");

            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'tanggalLahir' => $request->tanggalLahir,
                'noTelp' => $request->noTelp,
                'gender' => $request->gender,
            ]);

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }
}
