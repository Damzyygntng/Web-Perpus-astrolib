<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/petugasdatapengembalian.css') }}">
    <title>Kelola Data Pengembalian</title>
</head>
<body>
<div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
    <li class="active">
  <a href="/dashboard-admin">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li>
   <a href="/petugas-dashboard">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li>
  <a href="/kelolapeminjaman">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li>
  <a href="/admin/pengembalian">
    <img src="/gambar/trade.png"> Pengembalian
  </a>
</li>

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

  <div class="content">

    <!-- JUDUL -->

    <div class="judul">
        <h1>Generate Laporan Pengembalian</h1>
    </div>

    <!-- CARD -->

    <div class="card">

        <div class="top">

            <button class="btn-cetak" onclick="openPopup()">
                Cetak Laporan
            </button>

            <form method="GET">

                <div class="search-box">

                    <i class='bx bx-search'></i>

                    <input
                        type="text"
                        name="search"
                        placeholder="Cari pengguna..."
                        value="{{ request('search') }}"
                    >

                </div>

            </form>

        </div>

        <!-- TABLE -->

        <div class="table-container">

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

                    @forelse ($data as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->user->name ?? '-' }}</td>

                        <td>{{ $item->buku->judul ?? '-' }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d/m/Y') }}
                        </td>

                        <td>

<span 
class="status"
data-status="{{ strtolower($item->status_pengembalian ?? $item->status) }}"
>

{{ $item->status_pengembalian ?? $item->status }}

</span>

</td>

                        <td>
                            Rp {{ number_format($item->denda ?? 0,0,',','.') }}
                        </td>

                        <td>
                            {{ $item->petugas ?? 'Admin' }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="kosong">
                            Tidak ada data pengembalian
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- POPUP -->

<div class="popup" id="popup">

    <div class="popup-box">

        <div class="popup-header">
            Cetak Laporan
        </div>

        <div class="popup-body">

            <i class='bx bx-printer'></i>

            <h3>Cetak Laporan</h3>

            <p>
                Apakah anda ingin mencetak laporan pengembalian?
            </p>

        </div>

        <div class="popup-footer">

            <button class="btn-batal" onclick="closePopup()">
                Batal
            </button>

            <a href="/petugas/laporanpengembalian/pdf"
 class="btn-print">
                Cetak
            </a>

        </div>

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
      <a href="/logout" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="{{ asset('js/petugasdatapengembalian.js') }}"></script>
</body>
</html>