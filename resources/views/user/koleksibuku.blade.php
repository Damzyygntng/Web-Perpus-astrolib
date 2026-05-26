<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/koleksibuku.css') }}">
    <title>Koleksi Buku AstroLib</title>
</head>
<body>
    <div class="navbar">
    <div class="logo">
        <img src="/gambar/AstroLib.png">
    </div>

    <ul class="menu">
    <li><a href="home">Beranda</a></li>
    <li><a href="home#tentang">Tentang</a></li>
    <li><a href="koleksibuku">Koleksi</a></li>
    <li><a href="home#kontak">Kontak</a></li>
</ul>

    <div class="nav-right">

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

    <a href="/peminjaman" class="user-item">
      <img src="/gambar/profil.png">
      <span>Profile</span>
    </a>

    <a href="/peminjaman" class="user-item">
      <img src="/gambar/buku cilik.png">
      <span>Riwayat Peminjaman</span>
    </a>

    <a href="/pengembalian" class="user-item">
      <img src="/gambar/barter mini.png">
      <span>Riwayat Pengembalian</span>
    </a>

    <!-- FIX: tadi dobel koleksi, gue ganti jadi pengembalian -->
    <a href="/koleksiprib" class="user-item">
      <img src="/gambar/kantong.png">
      <span>Koleksi Pribadi</span>
    </a>

    <hr>

    <a href="#" class="user-item logout" onclick="openLogoutPopup()">
      <img src="/gambar/log out red.png">
      <span>Log out</span>
    </a>

  </div>
</div>
    </div>
</div>

<section class="hero">
    <div class="hero-content">
        <h1>
            Temukan Buku Favoritmu <br>
            di <span>AstroLib</span>
        </h1>

        <p>
            Dari fiksi sampai pengembangan diri, semua ada disini,
            cari, pinjam, dan mulai baca kapan saja
        </p>

        <div class="search-box">
            <input type="text" placeholder="Cari judul buku, penulis...">
            <button>Cari</button>
        </div>
    </div>
</section>

<section class="rekomendasi">
    <h3>Rekomendasi Untuk Kamu</h3>

    <div class="book-slider">
    @foreach($rekomendasi as $item)
        <div class="book-card">

            <img src="{{ $item->cover ? asset($item->cover) : asset('gambar/default.png') }}">

            <h4>{{ $item->judul }}</h4>
            <p>{{ $item->penulis }}</p>

            <span>⭐ {{ number_format($item->avg_rating ?? 0, 1) }}</span>

            <div class="btn-group">
                 <a href="/pinjam/{{ $item->id }}" class="btn-primary">Pinjam</a>
               <a href="/buku/{{ $item->id }}" class="btn-secondary">Detail</a>
            </div>

        </div>
    @endforeach
</div>
</section>

<section class="kategori">
    <h3>Kategori Buku</h3>

    <div class="kategori-btn">
    <button class="active"
        onclick="filterKategori('all', this)">Semua</button>
    @foreach ($kategori as $item)

        <button
          onclick="filterKategori('{{ strtolower(str_replace(' ', '-', $item->nama)) }}', this)">
    {{ $item->nama }}
</button>
    @endforeach
</div>

    <div class="book-container" id="bookContainer">
    @foreach($buku as $item)
        <div class="book-card {{ strtolower(str_replace(' ', '-', $item->kategori->nama ?? '')) }}">
            
           <img src="{{ $item->cover ? asset($item->cover) : asset('gambar/default.png') }}">

            <h4>{{ $item->judul }}</h4>
            <p>{{ $item->penulis }}</p>
            <span>⭐ {{ number_format($item->avg_rating, 1) ?? '-' }}</span>

            <div class="btn-group">
                <a href="/pinjam/{{ $item->id }}" class="btn-primary">Pinjam</a>
                <a href="/buku/{{ $item->id }}" class="btn-secondary">Detail</a>
            </div>
        </div>
    @endforeach
</div>
</section>


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

</div>
</body>
<script src="{{ asset('js/koleksibuku.js') }}"></script>
</html>