<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $categories = Category::all();

     
        if ($categories->isEmpty()) {
            $this->command->info('No categories found. Please run the CategorySeeder first.');
            return;
        }

     
        $titles = ['Annual Event', 'Tech Event', 'Innovation Event'];
        $locations = ['Pokhara', 'Kathmandu', 'Hetauda'];

        $descriptions = [
            'A great event to learn and grow.',
            'Join us for an informative session.',
            'Expand your network and knowledge.'
        ];

      
        foreach ($categories as $index => $category) {
            Event::create([
                'title' => $titles[$index],
                'description' => $descriptions[$index],
                'date' => Carbon::now()->addDays(rand(1, 30)), 
                'location' => $locations[$index],
                'category_id' => $category->id,
            ]);
        }
    }
}
