<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman</title>

    <style>
        body{
            font-family: sans-serif;
            padding: 30px;
            color: #333;
        }

        h2{
            margin-bottom: 30px;
        }

        .section{
            margin-bottom: 30px;
        }

        .title{
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        table{
            width: 100%;
        }

        td{
            padding: 8px 0;
            vertical-align: top;
        }

        .cover{
            width: 100px;
            border-radius: 10px;
        }

        .status{
            background: #d4f7df;
            color: green;
            padding: 8px 18px;
            border-radius: 20px;
            display: inline-block;
        }

        .note{
            margin-top: 30px;
            background: #f3f6fb;
            padding: 15px;
            border-radius: 10px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<h2>Bukti Peminjaman AstroLib</h2>

<div class="section">

    <div class="title">Data Peminjam</div>

    <table>
        <tr>
            <td width="150">Nama</td>
            <td>{{ Auth::user()->name }}</td>
        </tr>

        <tr>
            <td>Email</td>
            <td>{{ Auth::user()->email }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ Auth::user()->lokasi }}</td>
        </tr>
    </table>

</div>

<div class="section">

    <div class="title">Data Buku</div>

    <table>
        <tr>

            <td width="130">
                <img src="{{ public_path($pinjam->buku->cover) }}" class="cover">
            </td>

            <td>
                <p><b>Judul:</b> {{ $pinjam->buku->judul }}</p>
                <p><b>Penulis:</b> {{ $pinjam->buku->penulis }}</p>
                <p><b>Penerbit:</b> {{ $pinjam->buku->penerbit }}</p>
            </td>

        </tr>
    </table>

</div>

<div class="section">

    <div class="title">Detail Peminjaman</div>

    <table>
        <tr>

            <td>
                <b>Tanggal Pinjam</b><br>
                {{ $pinjam->tanggal_pinjam }}
            </td>

            <td>
                <b>Tanggal Kembali</b><br>
                {{ $pinjam->tanggal_kembali }}
            </td>

            <td>
                <b>Status</b><br>
                <span class="status">Disetujui</span>
            </td>

        </tr>
    </table>

</div>

<div class="note">
    Harap kembalikan buku tepat waktu agar tidak terkena denda keterlambatan.
</div>

</body>
</html>