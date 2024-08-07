<?php

namespace App\Http\Controllers;
use App\Models\Movie;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getMovies()
    {
        $movies = Movie::all();
        return view('getMovies', ['movies' => $movies]);
    }
}
