<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies List</title>
</head>
<body>
    <ul>
        @foreach($movies as $movie)
            <li>
                <h2>{{ $movie->title }}</h2>
                <h2>{{ $movie->image_url }}</h2>
                <!-- <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
                <p>Created At: {{ $movie->created_at }}</p>
                <p>Updated At: {{ $movie->updated_at }}</p> -->
            </li>
        @endforeach
    </ul>
</body>
</html>
