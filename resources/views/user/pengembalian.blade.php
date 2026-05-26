<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengembalian AstroLib</title>
    <link rel="stylesheet" href="css/pengembalian.css">
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
            <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}" class="avatar">
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
                    <h3>{{ $riwayatPeminjaman }}</h3>
                    <p>Riwayat Peminjaman</p>
                </div>
            </div>
        </div>


    </div>

    <!-- TABS -->
    <div class="tabs">
        <a href="/peminjaman">Riwayat Peminjaman</a>
        <a href="/pengembalian" class="active">Riwayat Pengembalian</a>
        <a href="/koleksiprib">Koleksi Pribadi</a>
    </div>

    <!-- EMPTY STATE -->
    @if($data->count() > 0)

<!-- CARD BUKU -->
<div class="pengembalian-wrapper">

@foreach($data as $item)

@php
$today = \Carbon\Carbon::now();
$deadline = \Carbon\Carbon::parse($item->tanggal_kembali);

$sisa = (int) $today->diffInDays($deadline, false);

@endphp

<div class="card-pengembalian">

    <!-- COVER -->
    <img src="{{ asset($item->buku->cover) }}" class="cover-buku">


    <!-- DETAIL -->
    <div class="detail-buku">

        <h2>
            {{ $item->buku->judul }}
        </h2>

        <p>
            {{ $item->buku->penulis }}
        </p>

    </div>


    <!-- TANGGAL -->
    <div class="tanggal-pengembalian">

        <div>
            <span>Dipinjam</span>

            <h4>
                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
            </h4>
        </div>

        <div>
            <span>Deadline</span>

            <h4>
                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d M Y') }}
            </h4>
        </div>

    </div>

    @if($item->denda > 0)

<div class="denda-box">

    ⚠️ Terlambat mengembalikan buku <br>

    Denda:
    <strong>
        Rp {{ number_format($item->denda,0,',','.') }}
    </strong>

</div>

@endif


    <div class="status-area">

    {{-- BELUM DIKEMBALIKAN --}}
    @if($item->status_pengembalian == 'belum')

        <span class="status warning">
            ⚠ Belum Dikembalikan
        </span>

    {{-- MENUNGGU --}}
    @elseif($item->status_pengembalian == 'menunggu')

        <span class="status warning">
            ⏳ Menunggu Persetujuan
        </span>

        <div class="button-group">

            <button type="button"
            class="btn-detail"

            onclick='openDetailModal(
            "{{ asset($item->buku->cover) }}",
            "{{ $item->buku->judul }}",
            "{{ $item->buku->penulis }}",
            "{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat("d F Y") }}",
            "{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat("d F Y") }}"
            )'>

                Lihat Detail

            </button>

        </div>

    {{-- SUDAH DIKEMBALIKAN --}}
    @elseif($item->status_pengembalian == 'disetujui')

        <span class="status selesai">
            Sudah Dikembalikan
        </span>

        <div class="button-group">

          <a href="/buku/{{ $item->buku_id }}?ulasan=1"
            class="btn-ulasan">

                Beri Ulasan

            </a>

            <a href="/pengembalian/cetak/{{ $item->id }}"
            class="btn-cetak">

                Cetak Bukti

            </a>

        </div>

    {{-- DITOLAK --}}
@elseif($item->status_pengembalian == 'ditolak')

    <span class="status ditolak">
        Pengembalian Ditolak
    </span>

    <div class="button-group">

        <button type="button"
        class="btn-detail"

        onclick='openTolakModal(
        "{{ $item->id }}",
        "{{ asset($item->buku->cover) }}",
        "{{ $item->buku->judul }}",
        "{{ $item->buku->penulis }}",
        "{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat("d F Y") }}",
        "{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat("d F Y") }}",
        "{{ $item->alasan_penolakan }}"
        )'>

            Lihat Detail

        </button>

    </div>

    @endif

</div>


<!-- BUTTON AREA -->
<div class="button-area">

    @if($item->status_pengembalian == 'belum')

        <button class="btn-kembali"

        onclick="openModal(
        '{{ $item->id }}',
        '{{ asset($item->buku->cover) }}',
        '{{ $item->buku->judul }}',
        '{{ $item->buku->penulis }}',
        '{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y') }}',
        '{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}'
        )">

            Kembalikan Buku

        </button>

    @endif

</div>

</div>

@endforeach

</div>

@else

<!-- EMPTY STATE -->
<div class="empty">

    <img src="/gambar/bukubalik.png">

    <h2>
        <span>Belum Ada</span> Pengembalian!
    </h2>

    <p>
        Kamu Belum Pernah Mengembalikan buku!
    </p>

    <p>
        Yuk Pinjam Buku di
        <span>AstroLib</span>
    </p>

    <a href="/koleksibuku"
    class="btn-pinjam">

        Mulai Pinjam Buku Sekarang

    </a>

</div>

@endif

<!-- MODAL KONFIRMASI -->
<div id="modalPengembalian" class="modal-bg">

    <div class="modal-box">

        <!-- CLOSE -->
        <button class="close-modal"
        onclick="closeModal()">

            ✕

        </button>

        <h2>Konfirmasi Pengembalian</h2>

        <hr>

        <!-- DETAIL PEMINJAMAN -->
        <div class="detail-section">

            <h4>Detail Peminjaman</h4>

            <div class="detail-buku-modal">

                <img id="modalCover"
                src=""
                class="modal-cover">

                <div class="modal-info-buku">

                    <h3 id="modalJudul"></h3>

                    <p id="modalPenulis"></p>

                    <div class="tanggal-modal">

                        <div>
                            <span>Tanggal Pinjam</span>
                            <p id="modalPinjam"></p>
                        </div>

                        <div>
                            <span>Tanggal Pengembalian</span>
                            <p id="modalKembali"></p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- DATA PEMINJAM -->
        <div class="detail-section">

            <h4>Data Peminjam</h4>

            <div class="data-user">

                <div>
                    <span>Nama</span>
                    <p>{{ Auth::user()->name }}</p>
                </div>

                <div>
                    <span>Email</span>
                    <p>{{ Auth::user()->email }}</p>
                </div>

                <div>
                    <span>Lokasi</span>
                    <p>{{ Auth::user()->lokasi ?? 'Belum diisi' }}</p>
                </div>

            </div>

        </div>

        <button class="btn-konfirmasi"
        onclick="submitPengembalian()">

    Konfirmasi Pengembalian

</button>

    </div>

</div>



<!-- MODAL SUCCESS -->
<div id="successModal" class="modal-bg">

    <div class="success-box">

        <button class="close-modal"
        onclick="closeSuccess()">

            ✕

        </button>

        <div class="check-icon">
            ✔
        </div>

        <h2>Permintaan Berhasil Diajukan!</h2>

        <p>
            Permintaan pengembalian buku kamu
            telah berhasil dikirim.
            Silahkan tunggu proses
            persetujuan dari petugas
        </p>

        <button class="btn-status"
        onclick="closeSuccess()">

            Lihat Status Pengembalian

        </button>

    </div>

</div>

<!-- MODAL DETAIL -->
<div id="detailModal" class="modal-bg">

    <div class="modal-box">

        <button class="close-modal"
        onclick="closeDetailModal()">

            ✕

        </button>

        <h2>Status Pengembalian</h2>

        <hr>

        <div class="detail-section">

            <h4>Detail Pengembalian</h4>

            <div class="detail-buku-modal">

                <img id="detailCover"
                class="modal-cover">

                <div class="modal-info-buku">

                    <h3 id="detailJudul"></h3>

                    <p id="detailPenulis"></p>

                    <div class="tanggal-modal">

                        <div>
                            <span>Tanggal Pinjam</span>
                            <p id="detailPinjam"></p>
                        </div>

                        <div>
                            <span>Deadline</span>
                            <p id="detailKembali"></p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="status-info-box">

            ⏳ Permintaan pengembalian sedang diproses admin

        </div>

    </div>

</div>

<!-- MODAL DETAIL PENGEMBALIAN -->
<!-- MODAL DITOLAK -->
<div class="modal-overlay" id="tolakModal">

    <div class="modal-box">

        <button class="close-btn" onclick="closeTolakModal()">
    &times;
</button>

        <h1>Status Pengembalian</h1>

        <hr>

        <h3>Detail Pengembalian</h3>

        <div class="detail-card">

            <img id="tolakCover" src="">

            <div class="detail-info">

                <h2 id="tolakJudul"></h2>

                <p id="tolakPenulis"></p>

                <div class="tanggal-area">

                    <div>
                        <span>Tanggal Pinjam</span>
                        <h4 id="tolakPinjam"></h4>
                    </div>

                    <div>
                        <span>Deadline</span>
                        <h4 id="tolakDeadline"></h4>
                    </div>

                </div>

            </div>

        </div>

        <div class="status-box ditolak-box">

            ❌ Pengembalian ditolak admin

        </div>

        <div class="alasan-box">

            <h4>Alasan Penolakan</h4>

            <p id="tolakAlasan"></p>

        </div>

        <a id="btnAjukanLagi"
class="btn-ajukan">
    Ajukan Pengembalikan
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

</div>
<script src="js/pengembalian.js"></script>
<script>

window.onclick = function(e){

    const modal = document.getElementById("tolakModal");

    if(e.target == modal){
        modal.style.display = "none";
    }

}

</script>
</body>
</html>