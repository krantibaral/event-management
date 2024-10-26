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

            $numberOfAttendees = rand(2, min(5, $totalAttendees));// rand function to  generate random attendees for an event

            $selectedAttendees = collect($attendeesArray)->shuffle()->take($numberOfAttendees); //shuffle to create unique attendees for an event
            foreach ($selectedAttendees as $name) {
                Attendee::create([
                    'name' => $name,
                    'email' => $attendees[$name],
                    'event_id' => $event->id,
                ]);
            }


            $attendeesArray = array_diff($attendeesArray, $selectedAttendees->toArray()); // remove selected attendees from the original array to prevent duplicates
        }
    }
}
