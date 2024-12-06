<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::with(['user', 'likes'])->withCount(['likes', 'views'])->latest();

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.posts-list', [
            'posts' => $query->paginate(10)
        ]);
    }
}
