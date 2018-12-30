<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Anime'
            ],
            [
                'title' => 'Comedy Films'
            ],
            [
                'title' => 'Action Films'
            ],
            [
                'title' => 'Comics'
            ],
            [
                'title' => 'Manga'
            ],
            [
                'title' => 'Fantasy'
            ],
            [
                'title' => 'Literature'
            ],
            [
                'title' => 'Other'
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'title' => $category["title"],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
