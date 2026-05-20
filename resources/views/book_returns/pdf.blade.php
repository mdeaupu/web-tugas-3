<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengembalian Buku</title>
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
        <h1>Laporan Pengembalian Buku</h1>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Buku</th>
                <th>Peminjam (NPM)</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Denda</th>
                <th>Jumlah Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $index => $return)
                @php
                    $detail = $return->loanDetail;
                    $loan = $detail->loan ?? null;
                    $book = $detail->book ?? null;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $return->id }}</td>
                    <td>{{ $book->title ?? '-' }}</td>
                    <td>{{ ($loan->user->first_name ?? '') . ' ' . ($loan->user->last_name ?? '') . ' (' . ($loan->user->npm ?? '') . ')' }}
                    </td>
                    <td>{{ $loan->loan_at ?? '-' }}</td>
                    <td>{{ $loan->return_at ?? '-' }}</td>
                    <td>{{ $return->created_at ?? '-' }}</td>
                    <td>{{ $return->charge ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ number_format($return->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Pengembalian: {{ $returns->count() }}</p>
    </div>
</body>

</html>