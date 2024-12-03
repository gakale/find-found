<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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

    public function show(Post $post)
    {
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
        ]);

        $post = auth()->user()->posts()->create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post créé avec succès!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }
}
