<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/petugas.css">
    <title>AstroLib Dashboard</title>
</head>
<body>
    <div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
    <li class="active">
  <a href="/petugas">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li>
  <a href="/petugas/kelolabuku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li>
  <a href="/petugaspinjam">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li>
 <a href="/petugas/pengembalian">
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

<div class="main">
  <div class="header">Dashboard</div>

  <div class="cards">
    <div class="card">
      <img src="/gambar/buku.png">
      <div>
        <h4>Total Buku</h4>
        <p>{{ $totalBuku }}</p>
      </div>
    </div>

    <div class="card">
      <img src="/gambar/buku.png">
      <div>
        <h4>Buku Dipinjam</h4>
        <p>{{ $bukuDipinjam }}</p>
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
      <a href="login" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="js/petugas.js"></script>
</body>
</html>