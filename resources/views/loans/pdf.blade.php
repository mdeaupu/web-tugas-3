<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman Buku</title>
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
        <h1>Laporan Peminjaman Buku</h1>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Peminjam</th>
                <th>NPM</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Jumlah Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $index => $loan)
                @php
                    $totalBooks = $loan->loanDetails->count();
                    $returnedCount = $loan->loanDetails->where('is_return', true)->count();
                    $status = ($returnedCount == $totalBooks) ? '✅ Semua Dikembalikan' : ($returnedCount > 0 ? '⚠️ Sebagian Kembali' : '❌ Belum Ada Pengembalian');
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</td>
                    <td>{{ $loan->user->npm }}</td>
                    <td>{{ $loan->loan_at }}</td>
                    <td>{{ $loan->return_at }}</td>
                    <td>{{ $totalBooks }}</td>
                    <td>{{ $status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Peminjaman: {{ $loans->count() }}</p>
    </div>
</body>

</html>