<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .header{
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2{
            margin-bottom: 5px;
        }

        .header p{
            margin: 0;
            color: #555;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th{
            background: #f1f1f1;
            padding: 12px;
            border: 1px solid #ccc;
            font-size: 13px;
        }

        table td{
            padding: 12px;
            border: 1px solid #ccc;
            font-size: 12px;
            vertical-align: top;
        }

        .status{
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .footer{
            width: 100%;
            margin-top: 70px;
        }

        .ttd{
            width: 250px;
            text-align: center;
            float: right;
        }

    </style>
</head>
<body>

    <div class="header">

        <h2>LAPORAN DATA PENGEMBALIAN BUKU</h2>

        <p>AstroLib - Perpustakaan Digital</p>

    </div>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tgl Peminjaman</th>
                <th>Tgl Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Petugas</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($data as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $item->user->name ?? '-' }}
                </td>

                <td>
                    {{ $item->buku->judul ?? '-' }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d/m/Y') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d/m/Y') }}
                </td>

                <td>
                    {{ $item->status_pengembalian ?? $item->status }}
                </td>

                <td>
                    Rp {{ number_format($item->denda ?? 0,0,',','.') }}
                </td>

                <td>
                    {{ $item->petugas ?? 'Admin' }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        <div class="ttd">

            <p>
                Bogor, Indonesia
                <br>
                {{ $tanggal }}
            </p>

            <br><br><br><br>

            <p>
                ____________________
                <br>
                Petugas / Admin
            </p>

        </div>

    </div>

</body>
</html>