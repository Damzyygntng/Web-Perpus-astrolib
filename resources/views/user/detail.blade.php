<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <title>Lihat Detail</title>
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

    <a href="javascript:void(0)" 
   class="user-item logout"
   onclick="openLogoutPopup()">
      <img src="/gambar/log out red.png">
      <span>Log out</span>
    </a>

  </div>
</div>
    </div>
</div>


   <div class="container">
  
  <!-- Back -->
  <a href="javascript:history.back()" class="back">← Back</a>

  <div class="content">

    <!-- LEFT: COVER -->
    <div class="cover">
      <img src="{{ $buku->cover ? asset($buku->cover) : asset('gambar/default.png') }}">
    </div>

    <!-- tengah -->
    <div class="details">
      <h1>{{ $buku->judul }}</h1>
          <p class="author">BY {{ $buku->penulis }}</p>

      <div class="rating">
       <span>⭐ {{ number_format($buku->avg_rating ?? 0, 1) }}</span>
      </div>

      <p class="desc">{{ $buku->sinopsis ?? '-' }}</p>

      <div class="info">
       <div><strong>Penerbit</strong><span>{{ $buku->penerbit }}</span></div>
        <div><strong>Tahun Terbit</strong><span>{{ $buku->tahun_terbit }}</span></div>
        <div><strong>ISBN</strong><span>{{ $buku->isbn ?? '-' }}</span></div>
        <div><strong>Halaman</strong><span>{{ $buku->halaman }} halaman</span></div>

      <div class="buttons">

    <a href="/pinjam/{{ $buku->id }}">
        <button class="primary">Pinjam</button>
    </a>

    <form action="/koleksi/{{ $buku->id }}" method="POST">
        @csrf
        <button type="submit" class="secondary">
            Tambah Koleksi Pribadi
        </button>
    </form>

</div>

   <!-- RIGHT: REVIEW -->
<div class="reviews">

    <h3>Ulasan Pembaca</h3>

    @foreach($buku->ulasans as $ulasan)

   <div class="review">

    <div class="avatar">
        <img src="{{ $ulasan->user->photo 
            ? asset('storage/uploads/' . $ulasan->user->photo)
            : asset('/gambar/man (1).png') }}">
    </div>

    <div class="review-content">

        <div class="review-header">

            <strong>{{ $ulasan->user->name }}</strong>

            <div class="stars">
                ⭐ {{ $ulasan->rating }}
            </div>

        </div>

        <p>{{ $ulasan->komentar }}</p>

    </div>

</div>

    @endforeach


    @if($showUlasan)

    <hr>

    <div class="review-input">

        <form action="/ulasan" method="POST">
            @csrf

            <input type="hidden" name="buku_id" value="{{ $buku->id }}">

            <div class="rating-input">
                <label>Rating</label>

                <select name="rating" required>
                    <option value="">Pilih</option>
                    <option value="1">⭐ 1</option>
                    <option value="2">⭐⭐ 2</option>
                    <option value="3">⭐⭐⭐ 3</option>
                    <option value="4">⭐⭐⭐⭐ 4</option>
                    <option value="5">⭐⭐⭐⭐⭐ 5</option>
                </select>
            </div>

            <textarea
                name="ulasan"
                placeholder="Ketik Ulasan Anda..."
                required
            ></textarea>

            <button type="submit" class="kirim-ulasan">
                Kirim Ulasan
            </button>

        </form>

    </div>

    @endif

</div>
  </div>

</div>

      
@if(session('success'))

<div id="popupSuccess" class="popup-overlay active">

    <div class="popup-success">

        <div class="check-icon">
            ✓
        </div>

        <h2>BERHASIL DISIMPAN!</h2>

        <p>
            Buku "{{ $buku->judul }}" telah <br>
            berhasil ditambah ke koleksi pribadi anda.
        </p>

        <a href="/koleksiprib">
            <button>Lihat Koleksi</button>
        </a>

        <span class="close-popup" onclick="closePopup()">✕</span>

    </div>

</div>

@endif

<div id="logoutPopup" class="logout-overlay">
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
<script src="{{ asset('js/detail.js') }}"></script>
</body>
</html>