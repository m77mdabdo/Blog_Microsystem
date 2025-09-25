<?php

namespace App\Repositories;

use App\Models\Post;
use App\RepositoryInterface\EditorPostRepositoryInterface;

class EditorPostRepository implements EditorPostRepositoryInterface
{
    public function allByUser($userId)
    {
        return Post::where('user_id', $userId)->get();
    }

    public function findByUser($userId, $id)
    {
        return Post::where('id', $id)->where('user_id', $userId)->firstOrFail();
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($userId, $id, array $data)
    {
        $post = $this->findByUser($userId, $id);
        $post->update($data);
        return $post;
    }

    public function delete($userId, $id)
    {
        $post = $this->findByUser($userId, $id);
        return $post->delete();
    }
}
