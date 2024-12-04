<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class Stats extends Component
{
    public $lostCount = 0;
    public $foundCount = 0;
    public $missingPersonCount = 0;
    public $activeUsersCount = 0;

    public function mount()
    {
        $this->lostCount = Post::where('type', 'lost')->count();
        $this->foundCount = Post::where('type', 'found')->count();
        $this->missingPersonCount = Post::where('type', 'missing_person')->count();
        $this->activeUsersCount = User::count();
    }

    public function render()
    {
        return view('livewire.stats');
    }
}
