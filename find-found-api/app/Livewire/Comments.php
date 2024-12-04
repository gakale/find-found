<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public Post $post;
    public $content = '';

    protected $rules = [
        'content' => 'required|string|min:3',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';
        $this->resetPage();
    }

    public function deleteComment(Comment $comment)
    {
        if (auth()->id() === $comment->user_id || auth()->id() === $this->post->user_id) {
            $comment->delete();
        }
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->post->comments()
                ->with('user')
                ->latest()
                ->paginate(5)
        ]);
    }
}
