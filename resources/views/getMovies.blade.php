<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Movies List</h1>
    <form action="/movies" method="GET">
        <div>
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="検索キーワード">
        </div>
        <div>
            <input type="radio" id="all" name="is_showing" value="all" {{ request('is_showing', 'all') == 'all' ? 'checked' : '' }}>
            <label for="all">すべて</label>
            <input type="radio" id="showing" name="is_showing" value="1" {{ request('is_showing') == '1' ? 'checked' : '' }}>
            <label for="showing">公開中</label>
            <input type="radio" id="upcoming" name="is_showing" value="0" {{ request('is_showing') == '0' ? 'checked' : '' }}>
            <label for="upcoming">公開予定</label>
        </div>
        <button type="submit">検索</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>映画タイトル</th>
                <th>画像URL</th>
                <th>公開年</th>
                <th>上映中かどうか</th>
                <th>概要</th>
                <th>登録日時</th>
                <th>更新日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->image_url }}</td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '公開予定' }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->created_at }}</td>
                    <td>{{ $movie->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $movies->links() }}
</body>
</html>
