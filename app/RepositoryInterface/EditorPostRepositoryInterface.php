<?php

namespace App\RepositoryInterface;

interface EditorPostRepositoryInterface
{
    public function allByUser($userId);
    public function findByUser($userId, $id);
    public function create(array $data);
    public function update($userId, $id, array $data);
    public function delete($userId, $id);
}
