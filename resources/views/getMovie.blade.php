<!DOCTYPE html>
<html>
<head>
    <title>{{ $movie->title }}</title>
</head>
<body>
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    <p>{{ $movie->description }}</p>
    <p>Published Year: {{ $movie->published_year }}</p>
    <p>Is Showing: {{ $movie->is_showing ? 'Yes' : 'No' }}</p>

    <h2>Schedule</h2>
    <table>
        <thead>
            <tr>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ (new \DateTime($schedule->start_time))->format('H:i') }}</td>
                    <td>{{ (new \DateTime($schedule->end_time))->format('H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
