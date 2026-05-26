<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/laporanpeminjaman.css">
    <title>Generate Laporan Peminjaman</title>
</head>
<body>
    <div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
    <li>
  <a href="/dashboard-admin">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li>
  <a href="/kategori">
    <img src="/gambar/kategori.png"> Kelola Kategori
  </a>
</li>

<li>
  <a href="/admin/kelola-buku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li>
  <a href="/kelolauser">
    <img src="/gambar/user putih.png"> Kelola User
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

<li>
  <a href="/kelolapetugas">
    <img src="/gambar/pegawai.png"> Kelola Petugas
  </a>
</li>

<li>
  <a href="{{ url('/kelolaulasan') }}">
    <img src="/gambar/cht.png"> Kelola Ulasan
  </a>
</li>
  <li class="dropdown">
  <div class="dropdown-toggle" id="dropdownBtn">
    <img src="/gambar/staf.png"> 
    Generate Laporan
    <img src="/gambar/arrow biru.png" class="arrow">
  </div>

  <ul class="dropdown-menu" id="dropdownMenu">
     <li><a href="/laporanbuku">Laporan Buku</a></li>
    <li><a href="/laporanuser">Laporan user</a></li>
    <li><a href="/laporanpetugas">Laporan Petugas</a></li>
     <li><a href="/laporanpeminjaman">Laporan Peminjaman</a></li>
    <li><a href="/laporanpengembalian">Laporan Pengembalian</a></li>
  </ul>
</li>

  <div class="logout">
    <li class="menu" onclick="openLogoutPopup()"><img src="/gambar/log out putih.png"> Log Out</li>
  </div>
</div>

<div class="box">

    <div class="judul">
        Generate Laporan Peminjaman
    </div>

    <div class="top">

        <button type="button" class="btn" onclick="openModal()">
            Cetak Laporan
        </button>

        <input type="text"
               class="search"
               placeholder="Cari Peminjam atau buku..">

    </div>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tgl Peminjaman</th>
                    <th>Tgl Pengembalian</th>
                    <th>Status</th>
                    <th>Petugas</th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $item)

                <tr>

                    <td>{{ $item->user->name }}</td>

                    <td>{{ $item->buku->judul }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}
                    </td>

                    <td>

                        @if($item->status == 'menunggu')
                            <span class="status status-menunggu">
                                Menunggu
                            </span>

                        @elseif($item->status == 'disetujui')
                            <span class="status status-disetujui">
                                Disetujui
                            </span>

                        @elseif($item->status == 'ditolak')
                            <span class="status status-ditolak">
                                Ditolak
                            </span>

                        @endif

                    </td>

                    <td>Astrodann</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL -->

<div class="modal" id="modalCetak">

    <div class="modal-box">

        <h3>Cetak Laporan</h3>

        <p>Anda yakin ingin mencetak laporan ini?</p>

        <div class="btn-group">

            <button class="btn-batal" onclick="closeModal()">
                Batal
            </button>

            <a href="/laporanpeminjaman/cetak">
                <button class="btn-cetak">
                    Cetak
                </button>
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
      <a href="login-admin" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="js/laporanpeminjaman.js"></script>
</body>
</html>