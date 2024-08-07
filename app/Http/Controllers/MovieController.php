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

    public function getAdminMovies()
    {
        $movies = Movie::all();
        return view('getAdminMovies', ['movies' => $movies]);
    }

    public function create()
    {
        return view('createMovie');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required',
            'is_showing' => 'sometimes|boolean'
        ]);

        Movie::create([
            'title' => $request->input('title'),
            'image_url' => $request->input('image_url'),
            'published_year' => $request->input('published_year'),
            'description' => $request->input('description'),
            'is_showing' => $request->has('is_showing')
        ]);

        return redirect('/admin/movies')->with('success', '映画作品が登録されました。');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('editMovie', ['movie' => $movie]);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:movies,title,' . $movie->id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required',
            'is_showing' => 'sometimes|boolean'
        ]);

        $movie->update([
            'title' => $request->input('title'),
            'image_url' => $request->input('image_url'),
            'published_year' => $request->input('published_year'),
            'description' => $request->input('description'),
            'is_showing' => $request->has('is_showing')
        ]);

        return redirect('/admin/movies')->with('success', '映画作品が更新されました。');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/admin/movies')->with('success', '映画作品が削除されました。');
    }
}
