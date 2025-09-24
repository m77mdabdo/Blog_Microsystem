<?php

namespace App\RepositoryInterface;

interface EditorRepositoryInterface
{
    public function all();
    public function findWithPosts($id);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
