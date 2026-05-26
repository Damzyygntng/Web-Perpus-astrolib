<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('css/petugaspinjam.css') }}">
    <title>Kelola Data Buku</title>
</head>
<body>
<div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
    <li>
   <a href="/petugas-dashboard">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li>
  <a href="/petugas/kelolabuku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li class="active">
 <a href="/petugaspinjam">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li>
  <a href="/petugas/pengembalian">
    <img src="/gambar/trade.png"> Pengembalian
  </a>
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

  <div class="content">
  <h2>Kelola Peminjaman</h2>

  <form method="GET" action="/petugaspinjam" class="top-bar">

    <select name="status" class="status-filter">

        <option value="">
            Semua Status
        </option>

        <option value="menunggu"
        {{ request('status') == 'menunggu' ? 'selected' : '' }}>
            Menunggu Persetujuan
        </option>

        <option value="disetujui"
        {{ request('status') == 'disetujui' ? 'selected' : '' }}>
            Disetujui
        </option>

        <option value="ditolak"
        {{ request('status') == 'ditolak' ? 'selected' : '' }}>
            Ditolak
        </option>

    </select>

    <input
        type="text"
        name="search"
        placeholder="Cari Peminjam atau buku..."
        class="search"
        value="{{ request('search') }}"
    >

    <button type="submit" class="filter-btn">
        Filter
    </button>

</form>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nama Peminjam</th>
          <th>Judul Buku</th>
          <th>Tgl Peminjaman</th>
          <th>Tgl Pengembalian</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
@foreach ($data as $item)
<tr>
  <td>{{ $item->user->name }}</td>
  <td>{{ $item->buku->judul ?? 'Buku tidak ditemukan' }}</td>
  <td>{{ $item->tanggal_pinjam }}</td>
  <td>{{ $item->tanggal_kembali }}</td>
  <td>
    <span class="status 
    @if($item->status == 'menunggu') pending 
    @elseif($item->status == 'disetujui') approved 
    @elseif($item->status == 'ditolak') rejected 
    @endif">
    {{ $item->status }}
</span>
  </td>
 <td>

@if($item->status == 'menunggu')

    <button 
        class="btn accept"
        onclick="openPopup(
        '{{ $item->id }}',
        '{{ $item->buku->judul ?? '-' }}',
        '{{ $item->buku->penulis ?? '-' }}',
        '{{ url($item->buku->cover) }}',
        '{{ $item->tanggal_pinjam }}',
        '{{ $item->tanggal_kembali }}',
        '{{ $item->user->name ?? '-' }}',
        '{{ $item->user->email ?? '-' }}',
        '{{ $item->user->lokasi ?? '-' }}'
        )">
        Terima
    </button>

   <button 
class="btn reject"
onclick="openPopupTolak(
'{{ $item->id }}',
'{{ $item->buku->judul ?? '-' }}',
'{{ $item->buku->penulis ?? '-' }}',
'{{ url($item->buku->cover) }}',
'{{ $item->tanggal_pinjam }}',
'{{ $item->tanggal_kembali }}',
'{{ $item->user->name ?? '-' }}',
'{{ $item->user->email ?? '-' }}',
'{{ $item->user->lokasi ?? '-' }}'
)">
Tolak
</button>

@elseif($item->status == 'disetujui')

    <span class="pinjam-badge">
    Sedang Dipinjam
</span>

@elseif($item->status == 'ditolak')

    <span class="rejected-badge">
        Ditolak
    </span>

@endif

</td>
</tr>
@endforeach
</tbody>
    </table>
  </div>
</div>
<!-- MODAL -->
<div id="popup" class="modal">
  <div class="modal-content">

    <span class="close" onclick="closePopup()">&times;</span>
    <h2>Terima Peminjaman</h2>

    <hr>

    <h3>Detail Peminjaman</h3>

    <div class="loan-modal-detail">
  <img id="coverBuku" class="loan-modal-book" src="/gambar/default.png">

  <div class="loan-modal-info">
    <h4 id="judulBuku" class="book-title">-</h4>
    <p id="penulisBuku" class="book-author">-</p>

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
        <div><span>Nama</span><span id="namaUser">-</span></div>
  <div><span>Email</span><span id="emailUser">-</span></div>
  <div><span>Lokasi</span><span id="lokasiUser">-</span></div>
    </div>
    <!-- BUTTON -->
    <div class="actions">
      <form id="formTerima" method="POST">
    @csrf
    @method('PUT')
       <button type="button" class="btn accept" onclick="terimaPeminjaman()">Terima</button>
      </form>
    </div>

  </div>
</div>

<!-- POPUP TOLAK -->
<div id="popupTolak" class="modal-tolak">

  <div class="modal-content-tolak">

    <span class="close-tolak" onclick="closePopupTolak()">
      &times;
    </span>

    <h2>Tolak Peminjaman</h2>

    <hr>

    <div class="loan-detail-tolak">

      <img 
        id="coverBukuTolak" 
        class="book-cover-tolak"
        src="/gambar/default.png"
      >

      <div class="loan-info-tolak">

        <h4 id="judulBukuTolak">-</h4>

        <p id="penulisBukuTolak">-</p>

        <div class="date-group-tolak">

          <div class="date-box-tolak">
            <span>Tanggal Pinjam</span>
            <span id="tglPinjamTolak">-</span>
          </div>

          <div class="date-box-tolak">
            <span>Tanggal Pengembalian</span>
            <span id="tglKembaliTolak">-</span>
          </div>

        </div>

      </div>

    </div>
    <hr>
    
    <h3>Data Peminjam</h3>

<div class="loan-user-tolak">

  <div>
    <span>Nama</span>
    <span id="namaUserTolak">-</span>
  </div>

  <div>
    <span>Email</span>
    <span id="emailUserTolak">-</span>
  </div>

  <div>
    <span>Lokasi</span>
    <span id="lokasiUserTolak">-</span>
  </div>

</div>

    <hr>

    <h3>Alasan Penolakan</h3>

    <textarea
      id="alasanPenolakan"
      class="textarea-tolak"
      placeholder="Masukkan alasan penolakan..."
    ></textarea>

    <div class="actions-tolak">

      <button 
        class="btn-batal-tolak"
        onclick="closePopupTolak()"
      >
        Batal
      </button>

      <button 
        class="btn-kirim-tolak"
        onclick="kirimPenolakan()"
      >
        Tolak
      </button>

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
<script src="{{ asset('js/petugaspinjam.js') }}"></script>
</body>
</html>