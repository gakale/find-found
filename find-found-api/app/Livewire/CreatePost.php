<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $type = 'lost';
    public $location = '';
    public $contact_phone = '';
    public $contact_email = '';
    public $has_reward = false;
    public $reward_amount = null;
    public $images = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:lost,found',
        'location' => 'required|string',
        'contact_phone' => 'nullable|string',
        'contact_email' => 'nullable|email',
        'has_reward' => 'boolean',
        'reward_amount' => 'nullable|numeric|min:0',
        'images.*' => 'image|max:2048', // 2MB max
    ];

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images);
        }
    }

    public function save()
    {
        $this->validate();

        $imagesPaths = [];
        foreach ($this->images as $image) {
            $imagesPaths[] = $image->store('posts', 'public');
        }

        $post = auth()->user()->posts()->create([
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'location' => $this->location,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'has_reward' => $this->has_reward,
            'reward_amount' => $this->has_reward ? $this->reward_amount : null,
            'images' => $imagesPaths,
        ]);

        session()->flash('success', 'Annonce créée avec succès!');
        
        return redirect()->route('posts.show', $post);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
