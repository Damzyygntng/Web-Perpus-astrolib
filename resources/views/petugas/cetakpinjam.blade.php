<!-- resources/views/admin/cetakpeminjaman.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>

    <style>

        body{
            font-family: sans-serif;
        }

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        p{
            text-align:center;
            margin-top:0;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th{
            background:#2d5be3;
            color:white;
            padding:12px;
            border:1px solid #000;
            font-size:13px;
        }

        td{
            border:1px solid #000;
            padding:10px;
            font-size:12px;
        }

        .ttd{
            width:100%;
            margin-top:70px;
        }

        .kanan{
            width:300px;
            float:right;
            text-align:center;
        }

    </style>

</head>
<body>

    <h2>LAPORAN DATA PEMINJAMAN BUKU</h2>

    <p>AstroLib Perpustakaan Digital</p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>

        <tbody>

            @foreach($data as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->user->name ?? '-' }}</td>

                <td>{{ $item->buku->judul ?? '-' }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d F Y') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d F Y') }}
                </td>

                <td>{{ $item->status }}</td>

                <td>Astrodann</td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="ttd">

        <div class="kanan">

            <p>
                Bogor, Indonesia <br>
                {{ $tanggal }}
            </p>

            <br><br><br>

            <p>
                _____________________ <br>
                Petugas / Admin
            </p>

        </div>

    </div>

</body>
</html>