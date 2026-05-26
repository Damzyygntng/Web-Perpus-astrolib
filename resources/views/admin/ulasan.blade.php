<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ulasan.css">
    <title>Kelola Buku</title>
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
  <a href="kategori">
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

<li class="active">
  <a href="ulasan">
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
     <li><a href="">Laporan Buku</a></li>
    <li><a href="">Laporan user</a></li>
    <li><a href="laporan_buku.php">Laporan Petugas</a></li>
     <li><a href="laporan_buku.php">Laporan Peminjaman</a></li>
    <li><a href="laporan_buku.php">Laporan Pengembalian</a></li>
  </ul>
</li>

  <div class="logout">
    <li class="menu" onclick="openLogoutPopup()"><img src="/gambar/log out putih.png"> Log Out</li>
  </div>
</div>

<div class="content">

    <div class="top-bar">

        <h1>Kelola Ulasan</h1>

        <form method="GET" class="search-box">

            <input
                type="text"
                name="search"
                placeholder="Cari pengguna..."
                value="{{ request('search') }}"
            >

            <button type="submit">
                Filter
            </button>

        </form>

    </div>

    <div class="ulasan-container">

        @foreach($ulasans as $ulasan)

<div class="ulasan-card">

    <div class="left">

        <img
            src="{{ $ulasan->user->photo ? asset('storage/uploads/' . $ulasan->user->photo) : asset('/gambar/man (1).png') }}"
            class="foto"
        >

        <div class="info">

            <h3>
                {{ $ulasan->user->name }}
            </h3>

            <p class="buku">
                Buku: {{ $ulasan->buku->judul }}
            </p>

            <div class="rating">
                ⭐ {{ $ulasan->rating }}
            </div>

            <p class="isi">
    {{ $ulasan->komentar }}
</p>

        </div>

    </div>

    <button
        type="button"
        class="hapus-btn"
        onclick="openHapus({{ $ulasan->id }})">
        Hapus
    </button>

</div>

@endforeach

    </div>

</div>

<div id="hapusOverlay" class="hapus-overlay">

    <div class="hapus-box">

        <div class="hapus-header">
            <h3>Hapus Ulasan</h3>

            <span onclick="closeHapus()">
                ✕
            </span>
        </div>

        <div class="hapus-content">

            <img src="/gambar/delete.png" class="hapus-icon">

            <h4>Hapus Ulasan?</h4>

            <p>
                Ulasan ini akan dihapus permanen.
            </p>

            <div class="hapus-actions">

                <button
                    type="button"
                    class="btn-batal"
                    onclick="closeHapus()">
                    Batal
                </button>

                <form id="formHapus" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn-hapus">
                        Hapus
                    </button>
                </form>

            </div>

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
<script src="js/ulasan.js"></script>
</body>
</html>