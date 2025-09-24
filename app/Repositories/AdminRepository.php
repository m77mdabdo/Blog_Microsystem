<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\RepositoryInterface\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function all()
    {
        return User::where('role', 'admin')->paginate(2);
    }

    public function find($id)
    {
        return User::where('role', 'admin')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['role'] = 'admin';
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $admin = $this->find($id);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $admin->update($data);
    }

    public function delete($id)
    {
        $admin = $this->find($id);
        return $admin->delete();
    }
}
