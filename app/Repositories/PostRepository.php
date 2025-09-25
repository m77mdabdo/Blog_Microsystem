<?php

namespace App\Repositories;

use App\Models\Post;
use App\RepositoryInterface\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function all($filters = [])
{
    $query = Post::query();

    if (!empty($filters['user_id'])) {
        $query->where('user_id', $filters['user_id']);
    }

    return $query->paginate(10);
}

    public function find($id)
    {
        return Post::findOrFail($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        return $post->delete();
    }
}
