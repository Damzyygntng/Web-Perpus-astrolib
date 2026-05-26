<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/laporanpetugas.css">
    <title>Generate Laporan Petugas</title>
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

<div class="content">

    <div class="topbar">
        <h2>Kelola Petugas</h2>
    </div>

    <div class="table-box">

        <div class="table-header">

             <button class="btn-cetak" onclick="openModal()">
                Cetak Laporan
            </button>

            <form method="GET">
                <input type="text"
                       name="search"
                       placeholder="Cari pengguna..."
                       class="search"
                       value="{{ request('search') }}">
            </form>

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

                @forelse($users as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ ucfirst($item->role) }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" style="text-align:center;">
                        Data tidak ditemukan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL -->

<div class="modal" id="modalCetak">

    <div class="modal-box">

        <div class="modal-header">
            Cetak Laporan
        </div>

        <div class="modal-body">

            <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png">

            <h3 style="margin-bottom:10px;">
                Cetak Laporan
            </h3>

            <p>
                Anda yakin ingin mencetak laporan ini?
            </p>

        </div>

        <div class="modal-footer">

            <button class="btn-batal" onclick="closeModal()">
                Batal
            </button>

            <a href="/laporanpetugas/cetak">
                <button class="btn-print">
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
<script src="js/laporanpetugas.js"></script>
</body>
</html>