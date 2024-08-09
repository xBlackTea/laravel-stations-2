<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - 映画詳細</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $movie->title }}</h1>
        <p>{{ $movie->description }}</p>
        <p>公開年: {{ $movie->published_year }}</p>
        <p>状態: {{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="img-fluid">

        <h2>スケジュール</h2>
        @if($movie->schedules->isEmpty())
            <p>現在スケジュールが設定されていません。</p>
        @else
            <ul>
            @foreach($movie->schedules as $schedule)
                <li>
                    開始: {{ $schedule->start_time->format('Y-m-d H:i:s') }} <br>
                    終了: {{ $schedule->end_time->format('Y-m-d H:i:s') }}
                </li>
            @endforeach
            </ul>
        @endif

        <a href="{{ url('/admin/movies/' . $movie->id . '/edit') }}" class="btn btn-primary">映画を編集</a>
        <a href="{{ url('/admin/movies') }}" class="btn btn-secondary">映画一覧に戻る</a>
    </div>
</body>
</html>
