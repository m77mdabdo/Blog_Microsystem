<?php

namespace App\RepositoryInterface;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
}
