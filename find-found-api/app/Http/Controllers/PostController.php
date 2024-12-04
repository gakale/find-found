<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return view('posts.index');
    }

    /**
     * Affiche une publication spécifique.
     */
    public function show(Post $post)
    {
        // Le modèle utilise déjà le slug comme clé de route
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:lost,found',
            'location' => 'required|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'has_reward' => 'boolean',
            'reward_amount' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $images[] = $path;
            }
            $validated['images'] = $images;
        }

        $post = auth()->user()->posts()->create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post créé avec succès!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Affiche les publications de l'utilisateur connecté
     */
    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('posts.my-posts', compact('posts'));
    }

    /**
     * Supprime une publication
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        // Supprimer les images associées au post
        if (!empty($post->images)) {
            foreach ($post->images as $image) {
                Storage::delete($image);
            }
        }

        $post->delete();

        return redirect()->route('posts.my-posts')
            ->with('success', 'Publication supprimée avec succès');
    }
}
