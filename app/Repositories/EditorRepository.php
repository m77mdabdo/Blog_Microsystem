<?php

namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterface\EditorRepositoryInterface;

class EditorRepository implements EditorRepositoryInterface
{
    public function all()
    {
        return User::where('role', 'editor')->get();
    }

    public function find($id)
    {
        return User::where('role', 'editor')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['role'] = 'editor';
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $editor = $this->find($id);
        $editor->update($data);
        return $editor;
    }

    public function delete($id)
    {
        $editor = $this->find($id);
        return $editor->delete();
    }
}
