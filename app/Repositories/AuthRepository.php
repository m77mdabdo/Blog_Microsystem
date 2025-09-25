<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\RepositoryInterface\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['access_token'] = Str::random(60);

        return User::create($data);
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        // Generate new token on login
        $user->access_token = Str::random(60);
        $user->save();

        return $user;
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->access_token = null;
            $user->save();
        }
    }
}
