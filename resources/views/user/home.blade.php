<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>AstroLib</title>
  <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <header class="navbar">
  <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>
  <nav>
    <a href="#">Beranda</a>
    <a href="#about">Tentang</a>
    <a href="koleksibuku">Koleksi</a>
    <a href="#kontak">Kontak</a>
  </nav>
 <div class="user-menu">
  <div class="user-trigger" onclick="toggleDropdown()">
    <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}" class="user-avatar">
    <span class="user-arrow">▼</span>
  </div>
  <div id="userDropdown" class="user-dropdown">
    <div class="user-header">
      <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}">
      @auth
    <span>{{ Auth::user()->name }}</span>
@endauth
    </div>
      <a href="peminjaman" class="user-item">
        <img src="/gambar/profil.png">
       <span>Profile</span>
  </a>
    <a href="peminjaman" class="user-item">
        <img src="/gambar/buku cilik.png">
        <span>Riwayat Peminjaman</span>
</a>
    <a href="pengembalian" class="user-item">
      <img src="/gambar/barter mini.png">
      <span>Riwayat Pengembalian</span>
</a>
    <a href="koleksiprib" class="user-item">
      <img src="/gambar/kantong.png">
      <span>Koleksi Pribadi</span>
</a>
    <hr>
    <a href="landingpage" class="user-item logout" onclick="openLogoutPopup()">
      <img src="/gambar/log out red.png">
      <span>Log out</span>
</a>
  </div>
</div>
</header>
<section class="hero">
  <div class="hero-container">
    <div class="hero-text">
      <h1>
        Jelajahi Dunia<br>Buku
        <span>Tanpa Batas</span>
      </h1>
      <p>
        AstroLib adalah platform perpustakaan digital yang memudahkan kamu membaca dan meminjam buku kapan saja, dimana saja.
      </p>
      <a href="#" class="hero-btn">Mulai Membaca</a>
    </div>
    <!-- KANAN (IMAGE) -->
    <div class="hero-image">
      <img src="/gambar/landingpage.png" alt="Ilustrasi Buku">
    </div>
  </div>
</section>

<section class="about">
  <div class="about-container">
    <div class="about-text">
      <h2>Apa Itu AstroLib?</h2>
      <p>
        AstroLib adalah perpustakaan digital modern dengan koleksi buku berkualitas dari berbagai kategori.
        Kami hadir untuk mempermudah membaca jadi lebih mudah, praktis, dan menyenangkan.
      </p>
    </div>
    <div class="about-cards">
      <div class="about-card">
        <img src="/gambar/book.png" alt="icon buku">
        <h4>Koleksi Lengkap</h4>
        <p>Banyak pilihan buku dari berbagai kategori.</p>
      </div>
      <div class="about-card">
        <img src="/gambar/flash (1).png" alt="icon">
        <h4>Akses Mudah</h4>
        <p>Baca dan pinjam buku kapan saja dengan mudah.</p>
      </div>
      <div class="about-card">
        <img src="/gambar/hp.png" alt="icon">
        <h4>Online Dimana Saja</h4>
        <p>Akses di berbagai perangkat tanpa batas.</p>
      </div>
    </div>
  </div>
</section>

<div class="book-section">
  <h4>Populer</h4>
  <h2>Buku Terfavorit</h2>

  <div class="book-container">
    
    <!-- Card 1 -->
    <div class="book-card">
      <img src="/gambar/pelakor.jpg" alt="Buku 1">
      <h3>Pelakor</h3>
      <p class="author">Edi abdullah</p>
      <div class="rating">⭐ 4.8</div>
    </div>

    <!-- Card 2 -->
    <div class="book-card">
      <img src="/gambar/menanti.jpg" alt="Buku 2">
      <h3>Menanti Restu Langit</h3>
      <p class="author">Makhasin</p>
      <div class="rating">⭐ 4.7</div>
    </div>

    <!-- Card 3 -->
    <div class="book-card">
      <img src="/gambar/Malaikat jatuh.jpg" alt="Buku 3">
      <h3>Malaikat Jatuh</h3>
      <p class="author">Clara Ng</p>
      <div class="rating">⭐ 4.6</div>
    </div>

    <!-- Card 4 -->
    <div class="book-card">
      <img src="/gambar/tka.jpeg" alt="Buku 4">
      <h3>Tes Kemampuan Akademik</h3>
      <p class="author">Tim Tentor Kompeten</p>
      <div class="rating">⭐ 4.5</div>
    </div>

    <div class="book-card">
      <img src="/gambar/Psikolog.jpg" alt="Buku 4">
      <h3>Psikolog Pendidikan</h3>
      <p class="author">Mahsup S.pd , M.pd.</p>
      <div class="rating">⭐ 4.5</div>
    </div>

    <div class="book-card">
      <img src="/gambar/Love at sight.png" alt="Buku 4">
      <h3>Love At First Sight</h3>
      <p class="author">Claudia Wilson</p>
      <div class="rating">⭐ 4.5</div>
    </div>

  </div>
</div>
</section>

<section class="cara-kerja">
  <div class="cara-container">
    <h3>Cara Kerja AstroLib</h3>
    <div class="cara-cards">
      <!-- CARD 1 -->
      <div class="cara-card">
        <span class="step">1.</span>
        <img src="/gambar/research.png" alt="">
        <h4>Cari Buku</h4>
        <p>Temukan buku favorit kamu</p>
      </div>
      <!-- CARD 2 -->
      <div class="cara-card">
        <span class="step">2.</span>
        <img src="/gambar/buku.png" alt="">
        <h4>Pilih & Lihat Detail</h4>
        <p>Baca detail sebelum meminjam</p>
      </div>
      <!-- CARD 3 -->
      <div class="cara-card">
        <span class="step">3.</span>
        <img src="/gambar/copywriting.png" alt="">
        <h4>Ajukan Peminjaman</h4>
        <p>Ajukan peminjaman dalam beberapa klik</p>
      </div>
      <!-- CARD 4 -->
      <div class="cara-card">
        <span class="step">4.</span>
        <img src="/gambar/clipboard.png" alt="">
        <h4>Tunggu Persetujuan</h4>
        <p>Tunggu konfirmasi dan ambil bukumu</p>
      </div>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer-container">

    <div class="footer-brand">
  <div class="brand-logo">
    <img src="/gambar/AstroLib.png" alt="AstroLib Logo">
  </div>
  <p>
    Platform perpustakaan digital yang membantu kamu menjelajahi dunia buku tanpa batas.
  </p>
</div>

    <!-- MENU -->
    <div class="footer-links">
      <h4>Menu</h4>
      <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Tentang</a></li>
        <li><a href="#">Buku</a></li>
      </ul>
    </div>

   <div class="footer-contact">
  <h4>Kontak</h4>
  <div class="contact-item">
    <img src="/gambar/mail.png" alt="Email">
    <p>dfirmansyah625@email.com</p>
  </div>
  <div class="contact-item">
    <img src="/gambar/telp.png" alt="Telepon">
    <p>0812-3456-7890</p>
  </div>
  <div class="contact-item">
    <img src="/gambar/loca.png" alt="Lokasi">
    <p>Bogor, Indonesia</p>
  </div>
</div>
    <!-- SOCIAL -->
    <div class="footer-social">
      <h4>Ikuti Kami</h4>
      <div class="social-icons">
        <a href="#"><img src="/gambar/tiktok.png" alt="TikTok"></a>
        <a href="#"><img src="/gambar/ig.png" alt="Instagram"></a>
        <a href="#"><img src="/gambar/facebook.png" alt="Facebook"></a>
      </div>
    </div>

  </div>
  <div class="footer-bottom">
    <p>© 2026 AstroLib. All rights reserved.</p>
  </div>
</footer>
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
      <a href="landingpage" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="js/home.js"></script>
</body>
</html>