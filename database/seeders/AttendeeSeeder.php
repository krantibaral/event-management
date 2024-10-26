<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendee;
use App\Models\Event;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            $this->command->info('No events found. Please run the EventSeeder first.');
            return;
        }

        $attendees = [
            'Ram' => 'ram@example.com',
            'Hari' => 'hari@example.com',
            'Sita' => 'sita@example.com',
            'Gita' => 'gita@example.com',
            'John' => 'john@example.com',
            'Jasmin' => 'jasmin@example.com',
        ];

        $attendeesArray = array_keys($attendees);
        $totalAttendees = count($attendeesArray);

        foreach ($events as $event) {
            //at least 1
            $numberOfAttendees = rand(1, $totalAttendees); // randomly choose between 1 and the total number of attendees

         
            $selectedAttendees = collect($attendeesArray)->shuffle()->take($numberOfAttendees);   // shuffle and select attendees for the current event

            // Create attendees for the current event
            foreach ($selectedAttendees as $name) {
                Attendee::create([
                    'name' => $name,
                    'email' => $attendees[$name],
                    'event_id' => $event->id,
                ]);
            }
        }
    }
}
