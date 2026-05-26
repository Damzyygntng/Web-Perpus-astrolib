<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family:sans-serif;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        .tanggal{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid black;
            padding:10px;
            font-size:12px;
        }

        table th{
            background:#f0f0f0;
        }

        .ttd{
            width:250px;
            text-align:center;
            margin-top:70px;
            float:right;
        }

    </style>

</head>
<body>

    <h2>LAPORAN DATA USER</h2>

    <div class="tanggal">
        Dicetak pada : {{ $tanggal }}
    </div>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Lokasi</th>
                <th>Tanggal Ditambahkan</th>
            </tr>
        </thead>

        <tbody>

            @foreach($users as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->lokasi ?? '-' }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="ttd">

        <p>
            Bogor, Indonesia<br>
            {{ $tanggal }}
        </p>

        <p>
            Petugas / Admin
        </p>

        <br><br><br>

        <p>
            ____________________
        </p>

    </div>

</body>
</html>