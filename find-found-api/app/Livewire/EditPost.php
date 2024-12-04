<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditPost extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Post $post;
    public $title;
    public $description;
    public $type;
    public $location;
    public $contact_phone;
    public $contact_email;
    public $has_reward;
    public $reward_amount;
    public $existingImages = [];
    public $newImages = [];

    public function mount(Post $post)
    {
        $this->authorize('update', $post);
        
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->type = $post->type;
        $this->location = $post->location;
        $this->contact_phone = $post->contact_phone;
        $this->contact_email = $post->contact_email;
        $this->has_reward = (bool) $post->has_reward;
        $this->reward_amount = $post->reward_amount;
        $this->existingImages = $post->images ?? [];
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:lost,found',
        'location' => 'required|string',
        'contact_phone' => 'nullable|string',
        'contact_email' => 'nullable|email',
        'has_reward' => 'boolean',
        'reward_amount' => 'nullable|numeric|min:0',
        'newImages.*' => 'image|max:2048',
    ];

    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            Storage::disk('public')->delete($this->existingImages[$index]);
            unset($this->existingImages[$index]);
            $this->existingImages = array_values($this->existingImages);
        }
    }

    public function removeNewImage($index)
    {
        if (isset($this->newImages[$index])) {
            unset($this->newImages[$index]);
            $this->newImages = array_values($this->newImages);
        }
    }

    public function update()
    {
        $this->authorize('update', $this->post);
        
        $this->validate();

        $imagesPaths = $this->existingImages;
        foreach ($this->newImages as $image) {
            $imagesPaths[] = $image->store('posts', 'public');
        }

        $this->post->update([
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

        session()->flash('success', 'Annonce mise à jour avec succès!');
        
        return redirect()->route('posts.show', $this->post);
    }

    public function delete()
    {
        $this->authorize('delete', $this->post);
        
        // Suppression des images
        if ($this->post->images) {
            foreach ($this->post->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $this->post->delete();

        session()->flash('success', 'Annonce supprimée avec succès!');
        
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
