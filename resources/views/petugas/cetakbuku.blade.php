<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Buku</title>

    <style>

        @page {
            margin: 25px;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin-top: 5px;
            font-size: 13px;
        }

        .line {
            border-bottom: 2px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f2f2f2;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            font-size: 11px;
        }

        table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
        }

        .cover {
            width: 60px;
            height: 80px;
            object-fit: cover;
        }

        .judul {
            text-align: left;
        }

        .footer {
            width: 250px;
            margin-left: auto;
            margin-top: 70px;
            text-align: center;
        }

        .ttd {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA BUKU</h2>
        <p>AstroLib - Perpustakaan Digital</p>
    </div>

    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Cover</th>
                <th width="25%">Judul Buku</th>
                <th width="15%">Penulis</th>
                <th width="10%">Stok</th>
                <th width="10%">Tersedia</th>
                <th width="10%">Dipinjam</th>
                <th width="13%">Tanggal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($bukus as $index => $buku)
            <tr>

                <td>
                    {{ $index + 1 }}
                </td>

              <td>

@php

$path = public_path(
    str_contains($buku->cover, 'gambar/')
    ? $buku->cover
    : 'gambar/' . $buku->cover
);

$type = pathinfo($path, PATHINFO_EXTENSION);

$data = file_exists($path)
    ? file_get_contents($path)
    : null;

@endphp

@if($data)

<img src="data:image/{{ $type }};base64,{{ base64_encode($data) }}" class="cover">

@endif

</td>

                <td class="judul">
                    {{ $buku->judul }}
                </td>

                <td>
                    {{ $buku->penulis }}
                </td>

                <td>
                    {{ $buku->stok }}
                </td>

                <td>
                    {{ $buku->stok }}
                </td>

                <td>
                    {{ $buku->dipinjam ?? 0 }}
                </td>

                <td>
                    {{ $buku->created_at->format('d/m/Y') }}
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>


    <div class="footer">
        <p>
            Bogor Indonesia, {{ $tanggal }}
        </p>

        <p>
            Admin / Petugas
        </p>

        <div class="ttd">
            ____________________
        </div>
    </div>

</body>
</html>