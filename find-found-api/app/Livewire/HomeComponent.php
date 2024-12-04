<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all';
    
    public function render()
    {
        $query = Post::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filter !== 'all') {
            $query->where('type', $this->filter);
        }

        $recentPosts = $query->latest()->take(6)->get();
        $totalPosts = Post::count();
        $foundItems = Post::where('type', 'found')->count();
        $lostItems = Post::where('type', 'lost')->count();
        $missingPersons = Post::where('type', 'missing')->count();

        return view('livewire.home-component', [
            'recentPosts' => $recentPosts,
            'totalPosts' => $totalPosts,
            'foundItems' => $foundItems,
            'lostItems' => $lostItems,
            'missingPersons' => $missingPersons,
        ]);
    }
}
