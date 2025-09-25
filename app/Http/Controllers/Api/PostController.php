<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function all()
    {
        $posts = Post::all();

        if ($posts->isEmpty()) {
            return response()->json(["msg" => "data not found"], 404);
        }

        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(["msg" => "data not found"], 404);
        }

        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title"   => "required|string|max:255",
            "content" => "required|string",
            "status"  => "required|in:draft,published",
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        $access_token = $request->header('access_token');
        $user = User::where('access_token', $access_token)->first();

        if (!$user) {
            return response()->json(['msg' => 'Invalid access token'], 401);
        }

        
        if (!$user->is_paid) {
            return response()->json(['msg' => 'You must complete the payment before creating a post.'], 403);
        }

        $post = Post::create([
            "title"   => $request->title,
            "content" => $request->content,
            "status"  => $request->status,
            "is_paid" => true,
            "user_id" => $user->id
        ]);

        return response()->json(["msg" => "Post created successfully", "post" => new PostResource($post)], 201);
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(["msg" => "Data not found"], 404);
        }

        $validator = Validator::make($request->all(), [
            "title"   => "sometimes|required|string|max:255",
            "content" => "sometimes|required|string",
            "status"  => "sometimes|required|in:draft,published",
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        $post->update($request->only(['title', 'content', 'status']));

        return response()->json(["msg" => "Post updated successfully", "post" => new PostResource($post)], 200);
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(["msg" => "data not found"], 404);
        }

        if ($post->image && Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();

        return response()->json(["msg" => "Post deleted successfully"], 200);
    }
}
