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

class AuthController extends Controller
{

    public function index()
    {
        // $news = addNews::all();
        // return response()->json($news);
        try {
            $user = User::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
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

    //Register
    public function register(Request $request)
    {
        $registrationData = $request->all();

        $validate = Validator::make($registrationData, [
            'username' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required',
            'tanggalLahir' => 'required',
            'noTelp' => 'required',
            'gender' => 'required',
            'imgProfile' => 'required',
            'imgSampul' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }


        // $data = Carbon::now()->format('y.m');
        // $count = User::count()+1;
        $registrationData['password'] = bcrypt($request->password);
        // $registrationData['id'] = "$data.$count";

        $user = User::create($registrationData);

        return response([
            'message' => 'Register Success',
            'data' => $user
        ], 200);
    }


    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        /**@var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;

        return response()->json([
            'message' => 'Success',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'nama' => $user->nama,
                'email' => $user->email,
                'noTelp' => $user->noTelp,
                'password' => $request->password,
                'gender' => $user->gender,
                'tanggalLahir' => $user->tanggalLahir,
                'imgProfile' => $user->imgProfile,
                'imgSampul' => $user->imgSampul,
            ]
        ], 200);
    }
    public function show($id)
    {
        try {
            $user = User::find($id);

            if (!$user) throw new \Exception("User tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $user
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required|max:60',
                'email' => 'required|email:rfc,dns|unique:users,email,' . $id,
                'password' => 'required',
                'tanggalLahir' => 'required',
                'noTelp' => 'required',
                'gender' => 'required',
            ]);

            $user = User::find($id);

            if (!$user) {
                throw new \Exception("User tidak ditemukan");
            }

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
