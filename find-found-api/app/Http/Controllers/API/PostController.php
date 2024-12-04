<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Post::with('user')->latest();

            // Filtrer par type (lost/found)
            if ($request->has('type')) {
                $query->where('type', $request->type);
            }

            // Recherche par titre ou description
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Pagination
            $posts = $query->paginate(10);
            
            return response()->json($posts);
        } catch (\Exception $e) {
            Log::error('Error in PostController@index: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Post $post)
    {
        try {
            // Incrémenter le compteur de vues
            $post->increment('views_count');
            
            return response()->json($post->load('user'));
        } catch (\Exception $e) {
            Log::error('Error in PostController@show: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|in:lost,found',
                'location' => 'required|string',
                'date' => 'required|date',
                'image' => 'nullable|image|max:2048', // 2MB max
                'reward_amount' => 'nullable|numeric|min:0'
            ]);

            $post = new Post($request->except('image'));
            $post->user_id = auth()->id();
            $post->status = 'active';

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('posts', 'public');
                $post->image_url = Storage::url($path);
            }

            $post->save();

            return response()->json($post->load('user'), 201);
        } catch (\Exception $e) {
            Log::error('Error in PostController@store: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Post $post)
    {
        try {
            // Vérifier si l'utilisateur est autorisé à modifier ce post
            if ($post->user_id !== auth()->id()) {
                return response()->json(['message' => 'Non autorisé'], 403);
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string',
                'date' => 'required|date',
                'image' => 'nullable|image|max:2048',
                'reward_amount' => 'nullable|numeric|min:0',
                'status' => 'nullable|in:active,resolved,closed'
            ]);

            $post->fill($request->except('image'));

            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($post->image_url) {
                    Storage::delete(str_replace('/storage', 'public', $post->image_url));
                }
                
                $path = $request->file('image')->store('posts', 'public');
                $post->image_url = Storage::url($path);
            }

            $post->save();

            return response()->json($post->load('user'));
        } catch (\Exception $e) {
            Log::error('Error in PostController@update: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            // Vérifier si l'utilisateur est autorisé à supprimer ce post
            if ($post->user_id !== auth()->id()) {
                return response()->json(['message' => 'Non autorisé'], 403);
            }

            // Supprimer l'image si elle existe
            if ($post->image_url) {
                Storage::delete(str_replace('/storage', 'public', $post->image_url));
            }

            $post->delete();

            return response()->json(['message' => 'Post supprimé avec succès']);
        } catch (\Exception $e) {
            Log::error('Error in PostController@destroy: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function userPosts()
    {
        try {
            $posts = Post::where('user_id', auth()->id())
                        ->with('user')
                        ->latest()
                        ->get();

            return response()->json($posts);
        } catch (\Exception $e) {
            Log::error('Error in PostController@userPosts: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
