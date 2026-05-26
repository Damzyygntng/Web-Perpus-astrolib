<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman AstroLib</title>
    <link rel="stylesheet" href="css/peminjaman.css">
</head>
<body>

<!-- NAVBAR -->
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
            <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}" class="avatar">
            @auth
           <h3>{{ Auth::user()->name }}</h3>
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
        <a href="/peminjaman" class="active">Riwayat Peminjaman</a>
        <a href="/pengembalian">Riwayat Pengembalian</a>
        <a href="/koleksiprib">Koleksi Pribadi</a>
    </div>

    @if($peminjaman->isEmpty())

<!-- EMPTY STATE -->
<div class="empty">
    <img src="/gambar/bukuteropong.png">
    <h2><span>Belum Ada</span> Buku Yang Dipinjam!</h2>
    <p>Sepertinya kamu belum meminjam buku apa pun.</p>
    <p>Yuk, mulai jelajahi koleksi kami dan temukan bacaan favoritmu!</p>

    <a href="/koleksibuku" class="btn-pinjam">Mulai Pinjam Buku Sekarang</a>
</div>

@else

<!-- LIST RIWAYAT -->
<div class="list-riwayat">

    @foreach($peminjaman as $pinjam)
    <div class="card-riwayat">

        <!-- COVER -->
         <img src="/{{ $pinjam->buku->cover }}" class="cover">

        <!-- INFO -->
<div class="info">

    <div class="info-left">
        <h4>{{ $pinjam->buku ? $pinjam->buku->judul : 'Buku tidak ditemukan' }}</h4>
        <p>{{ $pinjam->buku ? $pinjam->buku->penulis : '-' }}</p>
    </div>

    <div class="tanggal">
        <span>
            Dipinjam <br>
            {{ $pinjam->tanggal_pinjam }}
        </span>

        <span>
            Dikembalikan <br>
            {{ $pinjam->tanggal_kembali ?? '-' }}
        </span>
    </div>

</div>

        <!-- STATUS -->
        <div class="status-section">
           @if($pinjam->status == 'disetujui')
            <span class="status hijau">Disetujui</span>
            <small>Buku sedang dipinjam</small>

            @elseif($pinjam->status == 'ditolak')
            <span class="status merah">Ditolak</span>
            <small>{{ $pinjam->alasan_penolakan }}</small>

            @else
            <span class="status kuning">Menunggu</span>
            <small>Menunggu konfirmasi admin</small>

        @endif
        </div>

        <!-- BUTTON -->
        <div class="aksi">
            @if($pinjam->status == 'disetujui')
                <a href="/cetak-bukti/{{ $pinjam->id }}" class="btn-biru">Cetak Bukti</a>
            @else
                <button class="btn-abu" onclick="openDetailPopup(
'{{ url($pinjam->buku->cover) }}',
'{{ $pinjam->buku->judul }}',
'{{ $pinjam->buku->penulis }}',
'{{ $pinjam->tanggal_pinjam }}',
'{{ $pinjam->tanggal_kembali }}',
'{{ $pinjam->status }}',
'{{ $pinjam->alasan_penolakan }}'
)">Lihat Detail</button>
            @endif
        </div>

    </div>
    @endforeach

</div>

@endif

<!-- POPUP DETAIL -->
<div id="detailPopup" class="popup-overlay">

    <div class="detail-popup-box">

        <!-- CLOSE -->
        <span class="close-popup" onclick="closeDetailPopup()">✕</span>

        <!-- TITLE -->
        <h2>Detail Peminjaman</h2>

        <hr>

        <!-- CONTENT -->
        <div class="detail-content">

            <!-- COVER -->
            <img id="detailCover" src="" class="detail-cover">

            <!-- INFO -->
            <div class="detail-info">

                <h3 id="detailJudul"></h3>

                <p id="detailPenulis"></p>

                <div class="detail-row">
                    <span>Tanggal Pinjam</span>
                    <span id="detailPinjam"></span>
                </div>

                <div class="detail-row">
                    <span>Tanggal Pengembalian</span>
                    <span id="detailKembali"></span>
                </div>

                <div class="detail-row">
                    <span>Status</span>
                    <span id="detailStatus" class="status-mini"></span>
                </div>

            </div>

        </div>

        <hr>

        <!-- NOTE -->
        <div class="detail-note">
            Menunggu konfirmasi admin untuk persetujuan peminjaman buku.
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
      <a href="landingpage" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>

</div>
<script src="js/peminjaman.js"></script>
</body>
</html>