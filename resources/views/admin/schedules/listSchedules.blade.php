<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スケジュール一覧</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>スケジュール一覧</h1>
        @foreach($movies as $movie)
            <h2>{{ $movie->title }}</h2>
            <ul>
                @foreach($movie->schedules as $schedule)
                    <li>
                        <a href="{{ url('/admin/schedules/' . $schedule->id) }}">
                            {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ url('/admin/movies/' . $movie->id . '/schedules/create') }}">スケジュール追加</a>
        @endforeach
    </div>
</body>
</html>
