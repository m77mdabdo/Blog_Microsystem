<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\RepositoryInterface\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request)
{
    $this->postRepository->create($request->validated());
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        return view('post.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
{
    $this->postRepository->update($id, $request->validated());
    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
