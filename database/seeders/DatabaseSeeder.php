<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Practice;
use App\Models\Genre;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Practice::factory(10)->create();
        $this->call(GenresTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(SheetTableSeeder::class);
    }
}

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $genres = ['アクション', 'コメディ', 'ドラマ', 'ホラー', 'SF'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        Movie::factory(10)->create();
    }
}

class SchedulesTableSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();

        foreach ($movies as $movie) {
            \DB::table('schedules')->insert([
                ['movie_id' => $movie->id, 'start_time' => '10:00:00', 'end_time' => '12:00:00'],
                ['movie_id' => $movie->id, 'start_time' => '14:00:00', 'end_time' => '16:00:00']
            ]);
        }
    }
}
