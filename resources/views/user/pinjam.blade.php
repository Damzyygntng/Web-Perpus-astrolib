<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pinjam.css') }}">
    <title>Pinjam</title>
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

<div class="container">

<a href="javascript:history.back()" class="back">← Back</a>

  <!-- LEFT SIDE -->
  <div class="left">
    <div class="card-book">
     <img src="{{ $buku->cover ? asset($buku->cover) : '/gambar/default.png' }}" class="book-img">

      <button class="btn-detail" onclick="window.location.href='/detail/{{ $buku->id }}'">
  Lihat Detail Buku
</button>
      <p class="note">Masih Ragu? Lihat detail buku terlebih dahulu</p>
    </div>
  </div>

  <!-- RIGHT SIDE -->
  <div class="right">

    <div class="card-form">
      <div class="title">
        <img src="/gambar/mark.png" class="icon">
        <h3>Pinjam Buku</h3>
      </div>

      <div class="status">
        <img src="/gambar/checklist.png" class="icon-status">
        <div>
          <strong>Buku Tersedia</strong>
          <p>Stock: {{ $buku->stok }} buku</p>
        </div>
      </div>

      <label>Tanggal Pinjam</label>
      <div class="input-group">
        <img src="/gambar/kalender.png" class="icon-input">
        <input type="date">
      </div>

      <label>Tanggal Pengembalian</label>
      <div class="input-group">
        <img src="/gambar/kalender.png" class="icon-input">
        <input type="date">
      </div>

    <button type="button" id="btnPinjam" class="btn-submit" onclick="openLoanModal()" disabled>Pinjam Sekarang</button>

    <div class="rules">
      <div class="title">
        <img src="/gambar/shield.png" class="icon">
        <h4>Peraturan Peminjaman</h4>
      </div>

      <ul>
        <li>
          <img src="/gambar/repeat.png">
          Buku dapat diperpanjang 3 kali jika tidak ada pemesanan lain.
        </li>
        <li>
          <img src="/gambar/warning.png">
          Terlambat mengembalikan akan dikenakan denda sebesar Rp5.000 per hari.
        </li>
        <li>
          <img src="/gambar/buku2.png">
          Buku harus dikembalikan dalam kondisi baik dan lengkap.
        </li>
        <li>
          <img src="/gambar/waktu.png">
          Durasi maksimal peminjaman buku selama 21 hari atau 3 minggu.
        </li>
        <li>
          <img src="/gambar/ticket.png">
          Setiap peminjaman akan diberikan kode untuk mengambil buku.
        </li>
      </ul>
    </div>

  </div>

</div>

<!-- TARUH DI SINI ✅ -->
<div id="loanModal" class="loan-modal-overlay">
  <div class="loan-modal-box">

    <span class="loan-modal-close" onclick="closeLoanModal()">&times;</span>

    <h2>Konfirmasi Peminjaman</h2>
    <hr>

    <h3>Detail Peminjaman</h3>

    <div class="loan-modal-detail">
 <img src="{{ $buku->cover ? asset($buku->cover) : '/gambar/default.png' }}" class="loan-modal-book">

  <div class="loan-modal-info">
    <h4 class="book-title">{{ $buku->judul }}</h4>
    <p class="book-author">{{ $buku->penulis }}</p>

    <div class="loan-modal-date-group">
      <div class="loan-modal-date">
        <span>Tanggal Pinjam</span>
        <span id="tglPinjam">-</span>
      </div>

      <div class="loan-modal-date">
        <span>Tanggal Pengembalian</span>
        <span id="tglKembali">-</span>
      </div>
    </div>
  </div>
</div>

    <hr>

    <h3>Data Peminjam</h3>

    <div class="loan-modal-user">
      <div><span>Nama</span><span>{{ Auth::user()->name }}</span></div>
      <div><span>Email</span><span>{{ Auth::user()->email }}</span></div>
      <div><span>Lokasi</span><span>{{ Auth::user()->lokasi }}</span></div>
    </div>

    <form action="{{ route('pinjam.store') }}" method="POST">
  @csrf
  <input type="hidden" name="judul_buku" value="{{ $buku->judul }}">
  <input type="hidden" name="buku_id" value="{{ $buku->id }}">
  <input type="hidden" id="inputPinjam" name="tanggal_pinjam">
  <input type="hidden" id="inputKembali" name="tanggal_kembali">

  <button type="submit" class="loan-modal-btn">
    Konfirmasi Peminjaman
  </button>
</form>

  </div>
</div>

<div id="successModal" class="success-modal-overlay">

  <div class="success-modal-box">

    <!-- CLOSE -->
    <span class="success-close" onclick="closeSuccessModal()">&times;</span>

    <!-- ICON -->
    <div class="success-icon">
      <img src="/gambar/checklist.png">
    </div>

    <!-- TEXT -->
    <h2>Permintaan Berhasil Diajukan!</h2>

    <p>
      Permintaan Peminjaman buku kamu telah berhasil dikirim. <br>
      Silahkan tunggu proses persetujuan dari petugas
    </p>

    <!-- BUTTON -->
    <a href="/peminjaman" class="success-btn">
      Lihat Status Peminjaman
    </a>

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
      <a href="landingpage" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
@if(session('success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    openSuccessModal();
  });
</script>
@endif
<script src="{{ asset('js/pinjam.js') }}"></script>
</body>
</html>