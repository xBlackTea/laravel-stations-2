<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Movie</title>
</head>
<body>
    <h1>映画作品を編集</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/admin/movies/{{ $movie->id }}/update" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label for="title">映画タイトル</label>
            <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}">
        </div>
        <div>
            <label for="image_url">画像URL</label>
            <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $movie->image_url) }}">
        </div>
        <div>
            <label for="published_year">公開年</label>
            <input type="text" id="published_year" name="published_year" value="{{ old('published_year', $movie->published_year) }}">
        </div>
        <div>
            <label for="description">概要</label>
            <textarea id="description" name="description">{{ old('description', $movie->description) }}</textarea>
        </div>
        <div>
            <label for="is_showing">上映中かどうか</label>
            <input type="checkbox" id="is_showing" name="is_showing" value="1" {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }}>
        </div>
        <button type="submit">更新</button>
    </form>
</body>
</html>
