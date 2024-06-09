<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            $users = DB::table('users')
                ->where('email', $request->email)
                ->where('password', $request->password)
                ->first();

            if ($users) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Success',
                    'data' => $users
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Login Failed',
                    'data' => null
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error: ' . $e->getMessage(),
                'data' => null
            ], 402);
        }
    }
}