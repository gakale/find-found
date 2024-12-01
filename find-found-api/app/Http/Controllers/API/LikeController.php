<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $likes = $post->likes()
            ->with('user')
            ->latest()
            ->paginate(10);

        return response()->json($likes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Toggle like on a post.
     */
    public function toggle(Request $request, Post $post)
    {
        $existing_like = $post->likes()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing_like) {
            $existing_like->delete();
            $action = 'unliked';
        } else {
            $post->likes()->create([
                'user_id' => $request->user()->id
            ]);
            $action = 'liked';
        }

        return response()->json([
            'message' => "Post successfully {$action}",
            'likes_count' => $post->likes()->count()
        ]);
    }
}
