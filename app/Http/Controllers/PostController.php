<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::withCount('likes')->latest()->get();

        return response()->json([
            'data' => PostResource::collection($posts),
        ]);
    }

    public function toggleReaction(Request $request)
    {
        $validated = $request->validate([
            'post_id' => ['required', 'int', 'exists:posts,id'],
            'like' => ['required', 'boolean'],
        ]);
    
        $post = Post::find($request->post_id);
        if (! $post) {
            return response()->json([
                'status' => 404,
                'message' => 'model not found',
            ]);
        }
    
        if ($post->user_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post',
            ]);
        }
    
        $liked = $post->likes()->toggle(auth()->id(), $validated['like']);

        if ($liked['attached']) {
            return response()->json([
                'status' => 200,
                'message' => 'You liked this post successfully',
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'You unliked this post successfully',
            ]);
        }
    }
}
