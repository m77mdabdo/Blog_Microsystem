<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
   
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }


        $password = bcrypt($request->password);
        $access_token = Str::random(64);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'access_token' => $access_token,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user),
            'access_token' => $access_token,
        ], 201);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }


        $user->update([
            'access_token' => Str::random(64),
        ]);

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'access_token' => $user->access_token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $access_token = $request->header('access_token');

        if (!$access_token) {
            return response()->json([
                'message' => 'Access token is required',
            ], 401);
        }

        $user = User::where('access_token', $access_token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid access token',
            ], 401);
        }


        $user->update([
            'access_token' => null,
        ]);

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }
}
