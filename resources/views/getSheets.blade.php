<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席表</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .screen {
            background-color: #ccc;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>座席表</h1>
    <table>
        <thead>
            <tr>
                <th colspan="6" class="screen">スクリーン</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sheets as $row => $seats)
                <tr>
                    @foreach ($seats as $seat)
                        <td>{{ ($seat->row) }}-{{ $seat->column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
