<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スケジュール詳細</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>スケジュール詳細</h1>
        <p>開始時刻: {{ $schedule->start_time->format('H:i') }}</p>
        <p>終了時刻: {{ $schedule->end_time->format('H:i') }}</p>
        <a href="{{ url('/admin/schedules/' . $schedule->id . '/edit') }}">編集</a>
        <form action="{{ url('/admin/schedules/' . $schedule->id . '/destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
        </form>
    </div>
</body>
</html>
