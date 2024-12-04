<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $items = [
            'iPhone 13', 'Portefeuille en cuir', 'Clés de voiture', 'Sac à dos', 
            'Montre connectée', 'Lunettes de soleil', 'Appareil photo', 'Ordinateur portable'
        ];

        $locations = [
            'Gare centrale', 'Parc municipal', 'Centre commercial', 'Bibliothèque',
            'Station de métro', 'Restaurant Le Central', 'Université', 'Place du marché'
        ];

        foreach ($users as $user) {
            // Créer 2-4 posts pour chaque utilisateur
            $numPosts = rand(2, 4);
            
            for ($i = 0; $i < $numPosts; $i++) {
                $type = rand(0, 1) ? 'lost' : 'found';
                $itemIndex = array_rand($items);
                $locationIndex = array_rand($locations);
                
                Post::create([
                    'user_id' => $user->id,
                    'title' => ($type === 'lost' ? 'Perdu : ' : 'Trouvé : ') . $items[$itemIndex],
                    'description' => "Un(e) {$items[$itemIndex]} " . 
                                   ($type === 'lost' ? 'perdu(e)' : 'trouvé(e)') . 
                                   " à {$locations[$locationIndex]}",
                    'type' => $type,
                    'location' => $locations[$locationIndex],
                    'date' => now()->subDays(rand(1, 30)),
                    'status' => 'active',
                    'image_url' => 'https://via.placeholder.com/400x300',
                    'reward_amount' => $type === 'lost' ? rand(0, 100) * 5 : 0,
                    'views_count' => rand(10, 200)
                ]);
            }
        }
    }
}
