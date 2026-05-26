<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Koleksi AstroLib</title>
    <link rel="stylesheet" href="css/koleksiprib.css">
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

<!-- CONTENT -->
<div class="container">

    <!-- PROFILE CARD -->
    <div class="profile-card">
        
        <div class="left">
           <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}"class="avatar">
            @auth
        `   <h3>{{ Auth::user()->name }}</h3>
            @endauth
            <p>{{ Auth::user()->email }}</p>
        </div>

         <div class="middle">

        <a href="/editprofile" class="btn-edit">
            <img src="/gambar/pensil.png" alt="">
            Edit Profile
        </a>

            <div class="info">
                <img src="/gambar/email biru.png">
                <div>
                    <span>Email</span>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="info">
                <img src="/gambar/user biru.png">
                <div>
                    <span>Nama</span>
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>

            <div class="info">
                <img src="/gambar/loca biru.png">
                <div>
                    <span>Lokasi</span>
                    <p>{{ Auth::user()->lokasi ?? 'Belum diisi' }}</p>
                </div>
            </div>
        </div>


        <div class="right">
            <div class="box">
                <img src="/gambar/book.png">
                <div>
                     <h3>{{ $sedangDipinjam }}</h3>
                    <p>Sedang di pinjam</p>
                </div>
            </div>

            <div class="box">
                <img src="/gambar/time.png">
                <div>
                    <h3>{{ $peminjaman->count() }}</h3>
                    <p>Riwayat Peminjaman</p>
                </div>
            </div>
        </div>


    </div>

    <!-- TABS -->
    <div class="tabs">
        <a href="/peminjaman">Riwayat Peminjaman</a>
        <a href="/pengembalian">Riwayat Pengembalian</a>
        <a href="/koleksiprib" class="active">Koleksi Pribadi</a>
    </div>

    @if($koleksi->count() > 0)

<div class="koleksi-container">

    @foreach($koleksi as $item)

    <div class="koleksi-card">

        <img src="{{ asset($item->buku->cover) }}" class="cover">

        <div class="info-buku">
            <h3>{{ $item->buku->judul }}</h3>
            <p>{{ $item->buku->penulis }}</p>
        </div>

        <div class="aksi">

            <a href="/detail/{{ $item->buku->id }}">
                <button class="pinjam">
                    Pinjam Buku
                </button>
            </a>

            <a href="/detail/{{ $item->buku->id }}">
                <button class="detail">
                    Detail Buku
                </button>
            </a>

        </div>

    </div>

    @endforeach

</div>

@else

<!-- EMPTY STATE -->
<div class="empty">
    <img src="/gambar/rakbuku.png">

    <h2>
        <span>Koleksi Pribadi</span> Kosong!
    </h2>

    <p>
        Kamu Belum menyimpan Buku apapun di koleksi pribadimu.
    </p>

    <p>
        mulai cari buku favoritmu sekarang
    </p>

    <a href="/koleksibuku" class="btn-pinjam">
        Tambah Buku
    </a>
</div>

@endif

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
<script src="js/koleksiprib.js"></script>
</body>
</html>