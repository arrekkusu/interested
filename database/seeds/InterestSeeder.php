<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interests = [
            [
                'title' => 'Avengers',
                'description' => 'Marvels favourite characters Join together to form Earth\'s Mightiest Heroes!',
                'members' => 1
            ],
            [
                'title' => 'Walking Dead',
                'description' => 'Rick and the Gang continue their mission for survival against the ever growing army of undead!',
                'members' => 1,
            ],
            [
                'title' => 'The Good Place',
                'description' => 'Join Kristin Bell and Ted Dansen in this hilarious comedy about the unexpected nature of the afterlife!',
                'members' => 1,
            ],
            [
                'title' => 'American Horror Story',
                'description' => 'The popular Netfilx Show featuring Jessica Lange, Evan Peters, Zachari Quinto, Sarah Paulson envisions more creative horror subjects every season',
                'members' => 1,
            ],
            [
                'title' => 'Preacher',
                'description' => 'Based on the popular Garth Enis comic book series of the same name, Preacher follows the life of Preacher Jesse Custer and his unusual unholy super power',
                'members' => 1,
            ],
           
        ];

        foreach ($interests as $interest) {
            DB::table('interests')->insert([
                'title' => $interest["title"],
                'description' => $interest["description"],
                'members' => $interest["members"],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
