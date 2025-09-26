<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $posts = $this->postRepository->all();
        } else {
            $posts = $this->postRepository->all(['user_id' => $user->id]);
        }

        return view('admin.post.index', compact('posts'));
    }
    public function show($id)
    {

        $post = $this->postRepository->find($id);
        $post->load(['user', 'payment']);

        return view('admin.post.show', compact('post'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

public function store(StorePostRequest $request)
{
    $data = $request->validated();
    $data['user_id'] = Auth::id();

    if (Auth::user()->role === 'editor') {
        $data['status'] = 'draft';
        $data['is_paid'] = false;
    }

    $post = $this->postRepository->create($data);

    if (Auth::user()->role === 'editor') {
        return redirect()->route('payment.create', ['post' => $post->id])
            ->with('info', 'Please complete the payment to publish your post.');
    }

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}



    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->validated();


        if ($request->has('title')) {
            $data['title'] = $request->input('title');
        }


        if (Auth::check() && Auth::user()->role !== 'admin') {
            unset($data['is_paid']);
        } else {

            $data['is_paid'] = (bool) $request->input('is_paid');
        }


        $this->postRepository->update($id, $data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
