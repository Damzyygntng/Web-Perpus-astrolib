<!-- resources/views/admin/cetakpetugas.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Petugas</title>

    <style>

        body{
            font-family:Arial, Helvetica, sans-serif;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        p{
            text-align:center;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid black;
            padding:10px;
            text-align:center;
            font-size:13px;
        }

        th{
            background:#f0f0f0;
        }

        .ttd{
            width:250px;
            float:right;
            text-align:center;
            margin-top:70px;
        }

    </style>
</head>
<body>

    <h2>Laporan Data Petugas</h2>

    <p>
        AstroLib Perpustakaan
    </p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Ditambahkan</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($users as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ ucfirst($item->role) }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="ttd">

            <p>
            Bogor, Indonesia<br>
            {{ date('d F Y') }}
        </p>

        <p>
            Petugas / Admin
        </p>

        <br><br><br><br>

        <p>
            ____________________
        </p>

    </div>

</body>
</html>