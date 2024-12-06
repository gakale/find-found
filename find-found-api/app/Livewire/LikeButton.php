<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class LikeButton extends Component
{
    public $post;
    public $liked;
    public $likesCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->liked = $post->isLikedByUser(auth()->id());
        $this->likesCount = $post->likes()->count();
    }

    public function toggleLike()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->liked) {
            $this->post->likes()->where('user_id', auth()->id())->delete();
            $this->liked = false;
            $this->likesCount--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->id()
            ]);
            $this->liked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
