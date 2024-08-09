<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class MovieController extends Controller
{
    public function getMovies(Request $request)
    {
        $query = Movie::query();

        if ($request->has('is_showing') && $request->input('is_showing') !== 'all') {
            $query->where('is_showing', $request->input('is_showing'));
        }

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            if ($keyword !== '') {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                });
            }
        }

        $movies = $query->paginate(20);

        return view('getMovies', ['movies' => $movies]);
    }

    public function getMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = \DB::table('schedules')->where('movie_id', $id)->orderBy('start_time')->get();

        return view('getMovie', compact('movie', 'schedules'));
    }



    public function adminMovies()
    {
        $movies = Movie::all();
        return view('admin.movies.adminMovies', ['movies' => $movies]);
    }

    public function adminShowMovie($id)
    {
        $movie = Movie::with('schedules')->findOrFail($id);
        return view('admin.movies.adminShowMovie', compact('movie'));
    }

    public function adminCreateMovies()
    {
        return view('admin.movies.adminCreateMovies');
    }

    public function adminStoreMovies(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required',
            'is_showing' => 'sometimes|boolean',
            'genre' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect('/admin/movies/create')
                ->withErrors($validator)
                ->withInput();
        }
    
        DB::beginTransaction();
        try {
            $genre = Genre::firstOrCreate(['name' => $request->input('genre')]);
    
            // データベースエラーをシミュレートするために意図的に例外をスロー
            if ($request->input('title') === str_repeat('test', 100)) {
                throw new Exception('Intentional Error');
            }
    
            Movie::create([
                'title' => $request->input('title'),
                'image_url' => $request->input('image_url'),
                'published_year' => $request->input('published_year'),
                'description' => $request->input('description'),
                'is_showing' => $request->has('is_showing'),
                'genre_id' => $genre->id
            ]);
    
            DB::commit();
    
            return redirect('/admin/movies')->with('success', '映画作品が登録されました。');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error during movie creation: ' . $e->getMessage());
            return response()->json(['error' => '映画作品の登録に失敗しました。'], 500);
        }
    }
    

    public function adminEditMovies($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.adminEditMovies', ['movie' => $movie]);
    }

    public function adminUpdateMovies(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:movies,title,' . $movie->id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required',
            'is_showing' => 'sometimes|boolean',
            'genre' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect('/admin/movies/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
    
        DB::beginTransaction();
        try {
            $genre = Genre::firstOrCreate(['name' => $request->input('genre')]);
    
            // データベースエラーをシミュレートするために意図的に例外をスロー
            if ($request->input('title') === str_repeat('test', 100)) {
                throw new Exception('Intentional Error');
            }
    
            $movie->update([
                'title' => $request->input('title'),
                'image_url' => $request->input('image_url'),
                'published_year' => $request->input('published_year'),
                'description' => $request->input('description'),
                'is_showing' => $request->has('is_showing'),
                'genre_id' => $genre->id
            ]);
    
            DB::commit();
    
            return redirect('/admin/movies')->with('success', '映画作品が更新されました。');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error during movie update: ' . $e->getMessage());
    
            // 例外を再スローしないで、500ステータスコードを返す
            return response()->json(['error' => '映画作品の更新に失敗しました。'], 500);
        }
    }

    public function adminDestroyMovies($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/admin/movies')->with('success', '映画作品が削除されました。');
    }
}
