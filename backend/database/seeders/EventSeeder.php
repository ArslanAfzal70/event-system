<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Treasure Hunts", "Five Up Group", "Main Black Curators", "Social Of Together", "Perfect Silver Inc", "Sparkling It Forest", "Eventagious Delight", "Jade Party Eventertainment", "Hella Expressions", "Seven Delight", "Adorn Guides", "Meeting On The Go", "Classy Running Functions"
        ];

        foreach ($data as $key => $value) {
            Event::create([
                'title' => $value,
                'description' => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et laborum ratione a, odio dicta reprehenderit! Dicta provident et rem labore.",
                "date_start" => Carbon::now(),
                "date_end" => Carbon::now()->addDay(mt_rand(1, 10)),
                "silver_price" => mt_rand(100, 200),
                "gold_price" => mt_rand(200, 300),
                "platinum_price" => mt_rand(300, 400),
                "capacity" => mt_rand(10, 20)
            ]);
        }
    }
}
