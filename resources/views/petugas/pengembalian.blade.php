<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="{{ asset('css/petugaspengembalian.css') }}">
    <title>Kelola Data Buku</title>
</head>
<body>
<div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
    <li>
  <a href="/petugas-dashboard">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li>
 <a href="/petugas/kelolabuku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li>
  <a href="/petugas/kelolabuku">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li class="active">
  <a href="/petugas/pengembalian">
    <img src="/gambar/trade.png"> Pengembalian
  </a>
</li>

  <li class="dropdown">
  <div class="dropdown-toggle" id="dropdownBtn">
    <img src="/gambar/staf.png"> 
    Generate Laporan
    <img src="/gambar/arrow biru.png" class="arrow">
  </div>

  <ul class="dropdown-menu" id="dropdownMenu">
    <li><a href="/petugas/laporanbuku">Laporan Buku</a></li>
     <li><a href="/petugas/laporanpeminjaman">Laporan Peminjaman</a></li>
    <li><a href="/petugas/laporanpengembalian">Laporan Pengembalian</a></li>
  </ul>
</li>

  <div class="logout">
    <li class="menu" onclick="openLogoutPopup()"><img src="/gambar/log out putih.png"> Log Out</li>
  </div>
</div>


  <!-- MAIN CONTENT -->
<div class="main-content">

    <!-- FILTER -->
<form method="GET" action="/petugas/pengembalian" class="top-bar">

    <div class="filter-left">

        <select name="status">

            <option value="">Semua Status</option>

            <option value="menunggu">
                Menunggu
            </option>

            <option value="dikembalikan">
                Dikembalikan
            </option>

            <option value="ditolak">
                Ditolak
            </option>

        </select>

        <input
            type="text"
            name="search"
            placeholder="Cari pengembalian buku..."
        >

        <button type="submit" class="filter-btn">
            Filter
        </button>

    </div>

</form>



    <!-- TABLE -->
    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Deadline</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

@foreach($data as $item)

@php

$today = \Carbon\Carbon::now();

$deadline =
\Carbon\Carbon::parse($item->tanggal_kembali);

$telat =
$today->greaterThan($deadline)
? $today->diffInDays($deadline)
: 0;

$denda = $telat * 5000;

@endphp

<tr>

    <!-- NAMA -->
    <td class="nama-user">

        {{ $item->user->name }}

    </td>


    <!-- JUDUL -->
    <td class="judul-buku">

        {{ $item->buku->judul }}

    </td>


    <!-- TGL -->
    <td>

        {{ $item->tanggal_pinjam }}

    </td>


    <!-- DEADLINE -->
    <td>

        {{ $item->tanggal_kembali }}

    </td>


    <!-- DENDA -->
    <td>

        @if($denda > 0)

            Rp {{ number_format($denda,0,',','.') }}

        @else

            -

        @endif

    </td>


    <!-- STATUS -->
    <td>

        @if($item->status_pengembalian == 'menunggu')

            <span class="status warning">

                Menunggu

            </span>

        @elseif($item->status_pengembalian == 'dikembalikan')

            <span class="status success">

                Sudah Dikembalikan

            </span>

        @else

            <span class="status danger">

                Ditolak

            </span>

        @endif

    </td>


    <!-- AKSI -->
    <td>

@if($item->status_pengembalian == 'menunggu')

<div class="aksi">

<button
class="btn-terima"

onclick="openTerima(
'{{ $item->id }}',
'{{ asset($item->buku->cover) }}',
'{{ $item->buku->judul }}',
'{{ $item->buku->penulis }}',
'{{ $item->user->name }}',
'{{ $item->user->email }}',
'{{ $item->user->lokasi }}',
'{{ $item->tanggal_pinjam }}',
'{{ $item->tanggal_kembali }}'
)">

Terima

</button>


<button
class="btn-tolak"

onclick="openTolak(
'{{ $item->id }}',
'{{ asset($item->buku->cover) }}',
'{{ $item->buku->judul }}',
'{{ $item->buku->penulis }}',
'{{ $item->user->name }}',
'{{ $item->user->email }}',
'{{ $item->user->lokasi }}',
'{{ $item->tanggal_pinjam }}',
'{{ $item->tanggal_kembali }}'
)">

Tolak

</button>

</div>

@elseif($item->status_pengembalian == 'dikembalikan')

<span class="done-text">

Sudah Dikembalikan

</span>

@else

<span class="tolak-text">

Ditolak

</span>

@endif

    </td>

</tr>

@endforeach

            </tbody>

        </table>

    </div>

</div>
<!-- END MAIN CONTENT -->



<!-- MODAL TERIMA -->
<div id="modalTerima" class="modal-overlay">

    <div class="modal-box">

        <button
        class="close-btn"
        onclick="closeTerima()">

            ✕

        </button>

        <h2>Terima Pengembalian</h2>

        <hr>

        <div class="detail-buku">

            <img id="terimaCover">

            <div>

                <h3 id="terimaJudul"></h3>

                <p id="terimaPenulis"></p>

                <div class="tgl-area">

                    <div>

                        <span>Tanggal Pinjam</span>

                        <p id="terimaPinjam"></p>

                    </div>

                    <div>

                        <span>Deadline</span>

                        <p id="terimaKembali"></p>

                    </div>

                </div>

            </div>

        </div>

        <hr>

        <div class="data-user">

            <h3>Data Peminjam</h3>

            <div class="user-row">

                <span>Nama</span>

                <p id="terimaNama"></p>

            </div>

            <div class="user-row">

                <span>Email</span>

                <p id="terimaEmail"></p>

            </div>

            <div class="user-row">

                <span>Lokasi</span>

                <p id="terimaLokasi"></p>

            </div>

        </div>

        <form id="formTerima" method="POST">

            @csrf

            <button class="btn-submit">

                Konfirmasi Pengembalian

            </button>

        </form>

    </div>

</div>



<!-- MODAL TOLAK -->
<div id="modalTolak" class="modal-overlay">

    <div class="modal-box">

        <button
        class="close-btn"
        onclick="closeTolak()">

            ✕

        </button>

        <h2>Tolak Pengembalian</h2>

        <hr>

        <div class="detail-buku">

            <img id="tolakCover">

            <div>

                <h3 id="tolakJudul"></h3>

                <p id="tolakPenulis"></p>

                <div class="tgl-area">

                    <div>

                        <span>Tanggal Pinjam</span>

                        <p id="tolakPinjam"></p>

                    </div>

                    <div>

                        <span>Deadline</span>

                        <p id="tolakKembali"></p>

                    </div>

                </div>

            </div>

        </div>

        <hr>

        <div class="data-user">

            <h3>Data Peminjam</h3>

            <div class="user-row">

                <span>Nama</span>

                <p id="tolakNama"></p>

            </div>

            <div class="user-row">

                <span>Email</span>

                <p id="tolakEmail"></p>

            </div>

            <div class="user-row">

                <span>Lokasi</span>

                <p id="tolakLokasi"></p>

            </div>

        </div>

        <hr>

        <h3>Alasan Penolakan</h3>

        <form id="formTolak" method="POST">

    @csrf

    <textarea
    name="alasan_penolakan"
    placeholder="Masukkan alasan penolakan..."
    required></textarea>

    <div class="btn-row">

        <button
        type="button"
        class="btn-batal"
        onclick="closeTolak()">

            Batal

        </button>

        <button
        type="submit"
        class="btn-submit-tolak">

            Tolak Pengembalian

        </button>

    </div>

</form>

    </div>

</div>


<div id="logoutPopup" class="popup-overlay">
  <div class="popup-box">

    <!-- ICON -->
    <img src="/gambar/logout.png" class="popup-icon">

    <!-- TEXT -->
    <h2>Konfirmasi Log Out</h2>
    <p>Yakin ingin keluar?</p>

    <!-- BUTTON -->
    <div class="popup-actions">
      <button class="btn cancel" onclick="closeLogoutPopup()">Batal</button>
      <a href="login" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="{{ asset('js/petugaspengembalian.js') }}"></script>
</body>
</html>