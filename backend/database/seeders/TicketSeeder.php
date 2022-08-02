<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Allison',
            'Arthur',
            'Ana',
            'Alex',
            'Arlene',
            'Alberto',
            'Barry',
            'Bertha',
            'Bill',
            'Bonnie',
            'Bret',
            'Beryl',
            'Chantal',
            'Cristobal',
            'Claudette',
        ];

        foreach ($data as $key => $value) {
            $id = mt_rand(1, 13);
            $chooseEvent = Event::where('id', $id)->select('silver_price as silver', 'gold_price as gold', 'platinum_price as platinum')->first()->toArray();
            $key = array_rand($chooseEvent);

            Ticket::create([
                'name' => $value,
                'email' => strtolower($value) . "@email.com",
                "phone" => "+971" . mt_rand(10000, 90000),
                "type" => $key,
                "price" => $chooseEvent[$key],
                "event_id" => $id,
            ]);
        }
    }
}
