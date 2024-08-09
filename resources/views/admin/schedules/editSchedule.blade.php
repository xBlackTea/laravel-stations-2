<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スケジュール編集</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>スケジュール編集</h1>
        <form action="{{ url('/admin/schedules/' . $schedule->id . '/update') }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
            <div>
                <label for="start_time_date">開始日付:</label>
                <input type="date" id="start_time_date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}">
                @error('start_time_date')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="start_time_time">開始時間:</label>
                <input type="time" id="start_time_time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}">
                @error('start_time_time')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="end_time_date">終了日付:</label>
                <input type="date" id="end_time_date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}">
                @error('end_time_date')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="end_time_time">終了時間:</label>
                <input type="time" id="end_time_time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}">
                @error('end_time_time')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">更新</button>
        </form>
    </div>
</body>
</html>
