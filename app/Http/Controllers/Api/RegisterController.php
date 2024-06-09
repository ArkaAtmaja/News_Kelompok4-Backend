<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'tanggalLahir' => 'required',
                'noTelp' => 'required',
                'gender' => 'required',
            ]);

            // Create a new user
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'tanggalLahir' => $request->tanggalLahir,
                'noTelp' => $request->noTelp,
                'gender' => $request->gender,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Register Success',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
