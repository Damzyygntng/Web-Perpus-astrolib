<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/petugasbuku.css') }}">
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

 <li class="active">
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

<div class="topbar">
    <h2>Kelola Buku</h2>

    <button class="btn-tambah" onclick="openTambah()">
        Tambah Buku
    </button>
</div>

<div class="filter-box">

<form method="GET" action="/petugas/kelolabuku">

<select name="kategori">

<option value="">Semua Kategori</option>

@foreach ($kategori as $k)

<option
value="{{ $k->id }}"
{{ request('kategori') == $k->id ? 'selected' : '' }}
>
{{ $k->nama }}
</option>

@endforeach

</select>

<button type="submit">
Filter
</button>

</form>

</div>

<div class="table-container">

<table>

<thead>
<tr>
    <th>Cover</th>
    <th>Judul Buku</th>
    <th>Penulis</th>
    <th>Stok</th>
    <th>Tersedia</th>
    <th>Dipinjam</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach ($bukus as $buku)

<tr>

<td>
<img src="{{ asset(
    str_contains($buku->cover, 'gambar/')
    ? $buku->cover
    : 'gambar/' . $buku->cover
) }}">
</td>

<td>{{ $buku->judul }}</td>
<td>{{ $buku->penulis }}</td>

<td>{{ $buku->stok }}</td>

<td>{{ $buku->stok - $buku->dipinjam }}</td>

<td>{{ $buku->dipinjam }}</td>

<td>

<div class="aksi">

<button
class="btn-edit"
onclick="openEdit(
{{ $buku->id }},
'{{ addslashes($buku->judul) }}',
'{{ addslashes($buku->penulis) }}',
'{{ $buku->kategori_id }}',
'{{ addslashes($buku->penerbit) }}',
'{{ $buku->tahun_terbit }}',
'{{ $buku->isbn }}',
'{{ $buku->halaman }}',
'{{ $buku->stok }}',
'{{ addslashes($buku->sinopsis) }}'
)"
>
Edit
</button>

<button
class="btn-hapus"
onclick="openDelete({{ $buku->id }})"
>
Hapus
</button>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal" id="modalForm">

<div class="modal-content">

<div class="modal-header">
<h3 id="judulModal">Tambah Buku</h3>

<span class="close" onclick="closeModal()">
&times;
</span>
</div>

<div class="modal-body">

<form
id="formBuku"
method="POST"
action="/petugas/kelolabuku"
enctype="multipart/form-data"
>

@csrf

<div class="upload-box" onclick="document.getElementById('cover').click()">

<input type="file" name="cover" id="cover">

<div id="preview">
 Upload Cover
</div>

</div>

<div class="form-grid">

<div class="form-group">
<label>Judul Buku</label>
<input type="text" name="judul" id="judul">
</div>

<div class="form-group">
<label>Tahun Terbit</label>
<input type="text" name="tahun_terbit" id="tahun">
</div>

<div class="form-group">
<label>Penulis</label>
<input type="text" name="penulis" id="penulis">
</div>

<div class="form-group">
<label>ISBN</label>
<input type="text" name="isbn" id="isbn">
</div>

<div class="form-group">
<label>Kategori</label>
<select name="kategori_id" id="kategori">
@foreach ($kategori as $k)
<option value="{{ $k->id }}">
    {{ $k->nama }}
</option>
@endforeach
</select>

</div>

<div class="form-group">
<label>Halaman</label>
<input type="text" name="halaman" id="halaman">
</div>

<div class="form-group">
<label>Penerbit</label>
<input type="text" name="penerbit" id="penerbit">
</div>

<div class="form-group">
<label>Stok</label>
<input type="text" name="stok" id="stok">
</div>

<div class="form-group" style="grid-column:span 2;">
<label>Sinopsis</label>
<textarea name="sinopsis" id="sinopsis"></textarea>
</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn-batal"
onclick="closeModal()"
>
Batal
</button>

<button type="submit" class="btn-submit">
Simpan
</button>

</div>

</form>

</div>

</div>

</div>

<!-- MODAL DELETE -->
<div class="modal" id="modalDelete">

<div class="delete-box">

<h2>Hapus Buku</h2>

<p>Yakin mau hapus buku ini?</p>

<form id="formDelete" method="POST">

@csrf
@method('DELETE')

<div class="delete-action">

<button type="button" class="btn-batal" onclick="closeDelete()">Batal</button>

<button type="submit" class="btn-hapus">
Hapus
</button>

</div>

</form>

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
<script src="{{ asset('js/petugasbuku.js') }}"></script>
</body>
</html>