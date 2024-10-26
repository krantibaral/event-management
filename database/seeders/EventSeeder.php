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

       
        $titles = ['Annual Event', 'Tech Event', 'Innovation Event', 'Networking Event', 'Workshop Event'];
        $locations = ['Pokhara', 'Kathmandu', 'Hetauda', 'Lalitpur', 'Bhaktapur'];

        $descriptions = [
            'A great event to learn and grow.',
            'Join us for an informative session.',
            'Expand your network and knowledge.',
            'Meet industry leaders and innovators.',
            'Hands-on workshop with experts.'
        ];

     
        for ($i = 0; $i < 5; $i++) {
            Event::create([
                'title' => $titles[$i],
                'description' => $descriptions[$i],
                'date' => Carbon::now()->addDays(rand(1, 30)),
                'location' => $locations[$i],
                'category_id' => $categories[$i % count($categories)]->id, //categories is cyclically distributed
            ]);
        }
    }
}
