<?php

namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterface\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function all()
    {
        return User::where('role', 'admin')->get();
    }

    public function find($id)
    {
        return User::where('role', 'admin')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['role'] = 'admin';
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $admin = $this->find($id);
        $admin->update($data);
        return $admin;
    }

    public function delete($id)
    {
        $admin = $this->find($id);
        return $admin->delete();
    }
}
