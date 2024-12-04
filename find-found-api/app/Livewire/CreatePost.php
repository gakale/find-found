<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CreatePost extends Component
{
    use WithFileUploads;

    public $type = 'lost';
    public $title;
    public $description;
    public $location;
    public $date;
    public $category;
    public $contact_phone;
    public $contact_email;
    public $has_reward = false;
    public $reward_amount;
    public $person_name;
    public $person_age;
    public $person_gender;
    public $person_height;
    public $person_weight;
    public $last_seen_date;
    public $last_seen_location;
    public $clothes_worn;
    public $distinctive_features;
    public $person_description;
    public $police_report_number;
    public $is_urgent = false;
    public $images = [];

    protected function rules()
    {
        $baseRules = [
            'type' => 'required|in:lost,found,missing_person',
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'location' => 'required',
            'date' => 'required|date',
            'contact_phone' => 'required|string',
            'contact_email' => 'nullable|email',
            'has_reward' => 'boolean',
            'reward_amount' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
        ];

        if ($this->type === 'missing_person') {
            return array_merge($baseRules, [
                'person_name' => 'required|min:2|max:255',
                'person_age' => 'nullable|numeric|min:0|max:150',
                'person_gender' => 'nullable|in:male,female,other',
                'person_height' => 'nullable|string|max:10',
                'person_weight' => 'nullable|string|max:10',
                'last_seen_date' => 'required|date',
                'last_seen_location' => 'required|string|max:255',
                'clothes_worn' => 'nullable|string',
                'distinctive_features' => 'nullable|string',
                'person_description' => 'nullable|string',
                'police_report_number' => 'nullable|string|max:50',
                'is_urgent' => 'boolean',
            ]);
        } else {
            return array_merge($baseRules, [
                'category' => 'required',
            ]);
        }
    }

    protected function messages()
    {
        return [
            'person_name.required' => 'Le nom de la personne est obligatoire',
            'person_name.min' => 'Le nom doit contenir au moins 2 caractères',
            'last_seen_date.required' => 'La date de dernière vue est obligatoire',
            'last_seen_location.required' => 'Le lieu de dernière vue est obligatoire',
            'title.required' => 'Le titre de l\'annonce est obligatoire',
            'description.required' => 'Une description est obligatoire',
            'description.min' => 'La description doit contenir au moins 10 caractères',
            'contact_phone.required' => 'Un numéro de téléphone est obligatoire pour vous contacter',
            'location.required' => 'Le lieu est obligatoire',
        ];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'last_seen_date' && $this->type === 'missing_person') {
            $this->date = $this->last_seen_date;
        }
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->type = request()->query('type', 'lost');
        if ($this->type === 'missing_person') {
            $this->date = $this->last_seen_date;
        }
    }

    public function save()
    {
        try {
            if ($this->type === 'missing_person') {
                $this->date = $this->last_seen_date;
            }
            
            $validatedData = $this->validate();
            
            $post = new Post();
            $post->user_id = auth()->id();
            $post->type = $validatedData['type'];
            $post->title = $validatedData['title'];
            $post->description = $validatedData['description'];
            $post->location = $validatedData['location'];
            $post->date = $validatedData['date'];
            $post->contact_phone = $validatedData['contact_phone'];
            $post->contact_email = $validatedData['contact_email'];
            $post->has_reward = $validatedData['has_reward'];
            $post->reward_amount = $validatedData['reward_amount'];

            if ($post->type === 'missing_person') {
                $post->person_name = $validatedData['person_name'];
                $post->person_age = $validatedData['person_age'];
                $post->person_gender = $validatedData['person_gender'];
                $post->person_height = $validatedData['person_height'];
                $post->person_weight = $validatedData['person_weight'];
                $post->last_seen_date = $validatedData['last_seen_date'];
                $post->last_seen_location = $validatedData['last_seen_location'];
                $post->clothes_worn = $validatedData['clothes_worn'];
                $post->distinctive_features = $validatedData['distinctive_features'];
                $post->person_description = $validatedData['person_description'];
                $post->police_report_number = $validatedData['police_report_number'];
                $post->is_urgent = $validatedData['is_urgent'];
            } else {
                $post->category = $validatedData['category'];
            }

            $imagesPaths = [];
            foreach ($this->images as $image) {
                $imagesPaths[] = $image->store('posts', 'public');
            }
            $post->images = $imagesPaths;

            $post->save();

            session()->flash('message', 'Annonce créée avec succès.');
            return redirect()->route('posts.index');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du post: ' . $e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de la création de l\'annonce. Veuillez réessayer.');
            $this->dispatch('show-validation-errors', ['errors' => $this->getErrorBag()->toArray()]);
        }
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
