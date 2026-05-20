<!DOCTYPE html>
<html>

<head>
    <title>Daftar Rak Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Daftar Rak Buku</h1>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Rak</th>
                <th>Nama Rak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookshelves as $index => $bookshelf)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bookshelf->code }}</td>
                    <td>{{ $bookshelf->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Rak: {{ $bookshelves->count() }}</p>
    </div>
</body>

</html>