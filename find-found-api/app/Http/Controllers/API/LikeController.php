<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $likes = $post->likes()->with('user')->latest()->get();
        
        return response()->json([
            'likes' => $likes
        ]);
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
    public function toggle(Post $post)
    {
        $user = auth()->user();
        $existing_like = $post->likes()->where('user_id', $user->id)->first();

        if ($existing_like) {
            $existing_like->delete();
            $action = 'unliked';
        } else {
            $post->likes()->create([
                'user_id' => $user->id
            ]);
            $action = 'liked';
        }

        return response()->json([
            'action' => $action,
            'likes_count' => $post->likes()->count()
        ]);
    }

    /**
     * Get the likes count of a post.
     */
    public function count(Post $post)
    {
        return response()->json([
            'likes_count' => $post->likes()->count(),
            'user_has_liked' => $post->likes()->where('user_id', auth()->id())->exists()
        ]);
    }
}
