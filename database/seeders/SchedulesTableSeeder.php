<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class SchedulesTableSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();

        foreach ($movies as $movie) {
            DB::table('schedules')->insert([
                [
                    'movie_id' => $movie->id,
                    'start_time' => '10:00:00',
                    'end_time' => '12:00:00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'movie_id' => $movie->id,
                    'start_time' => '14:00:00',
                    'end_time' => '16:00:00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
