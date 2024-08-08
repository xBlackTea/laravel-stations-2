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