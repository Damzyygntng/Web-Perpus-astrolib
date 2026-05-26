<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
    <title>Kelola Kategori</title>
</head>
<body>
     <div class="sidebar">
 <div class="logo">
    <img src="/gambar/AstroLib.png">
  </div>

  <ul class="menu">
   <li>
  <a href="/dashboard-admin">
    <img src="/gambar/home.png"> Dashboard
  </a>
</li>

<li class="active">
  <a href="/kategori">
    <img src="/gambar/kategori.png"> Kelola Kategori
  </a>
</li>

<li>
  <a href="/admin/kelola-buku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li>
  <a href="/kelolauser">
    <img src="/gambar/user putih.png"> Kelola User
  </a>
</li>

<li>
  <a href="/kelolapeminjaman">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li>
  <a href="/admin/pengembalian">
    <img src="/gambar/trade.png"> Pengembalian
  </a>
</li>

<li>
  <a href="/kelolapetugas">
    <img src="/gambar/pegawai.png"> Kelola Petugas
  </a>
</li>

<li>
  <a href="/ulasan">
    <img src="/gambar/cht.png"> Kelola Ulasan
  </a>
</li>
  <li class="dropdown">
  <div class="dropdown-toggle" id="dropdownBtn">
    <img src="/gambar/staf.png"> 
    Generate Laporan
    <img src="/gambar/arrow biru.png" class="arrow">
  </div>

 <ul class="dropdown-menu" id="dropdownMenu">
     <li><a href="/laporanbuku">Laporan Buku</a></li>
    <li><a href="/laporanuser">Laporan user</a></li>
    <li><a href="/laporanpetugas">Laporan Petugas</a></li>
     <li><a href="/laporanpeminjaman">Laporan Peminjaman</a></li>
    <li><a href="/laporanpengembalian">Laporan Pengembalian</a></li>
  </ul>
</li>

  <div class="logout">
    <li class="menu" onclick="openLogoutPopup()"><img src="/gambar/log out putih.png"> Log Out</li>
  </div>
</div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">

            <h2>Kelola Kategori</h2>

        </div>

        <!-- CONTENT -->
        <div class="content">

            <div class="table-card">

                <div class="table-header">

                    <button class="btn-primary" onclick="openTambah()">
                        Tambah Kategori
                    </button>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($kategori as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->nama }}</td>

                            <td class="aksi">

                                <button class="btn-edit"
                                    onclick="openEdit({{ $item->id }}, '{{ $item->nama }}')">
                                    Edit
                                </button>

                                <button class="btn-delete"
                                    onclick="openHapus({{ $item->id }})">
                                    Hapus
                                </button>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH -->

<div class="modal" id="modalTambah">

    <div class="modal-box">

        <div class="modal-header">
            <h3>Tambah Kategori</h3>
        </div>

        <form action="/kategori/store" method="POST">

            @csrf

            <div class="modal-body">

                <label>Kategori</label>

                <input type="text"
                       name="nama"
                       required>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn-cancel"
                        onclick="closeTambah()">
                    Batal
                </button>

                <button type="submit"
                        class="btn-primary">
                    Tambah
                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL EDIT -->

<div class="modal" id="modalEdit">

    <div class="modal-box">

        <div class="modal-header">
            <h3>Edit Kategori</h3>
        </div>

        <form id="formEdit" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-body">

                <label>Kategori</label>

                <input type="text" name="nama" id="editKategori">

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn-cancel"
                        onclick="closeEdit()">
                    Batal
                </button>

                <button type="submit"
                        class="btn-primary">
                    Edit
                </button>

            </div>

        </form>

    </div>

</div>

<!-- MODAL HAPUS -->

<div class="modal" id="modalHapus">

    <div class="modal-delete">

        <div class="delete-header">

            <h3>Hapus Kategori</h3>

            <span onclick="closeHapus()">✕</span>

        </div>

        <div class="delete-body">

            <h4>Hapus kategori?</h4>

            <p>Kategori ini akan dihapus permanen.</p>

            <form id="formHapus" method="POST">

                @csrf
                @method('DELETE')

                <div class="delete-btn">

                    <button type="button"
                            class="btn-grey"
                            onclick="closeHapus()">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-delete">
                        Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- POPUP LOGOUT -->

<div id="logoutPopup" class="popup-overlay">

    <div class="popup-box">

        <img src="/gambar/logout.png" class="popup-icon">

        <h2>Konfirmasi Log Out</h2>

        <p>Yakin ingin keluar?</p>

        <div class="popup-actions">

            <button class="btn cancel"
                    onclick="closeLogoutPopup()">
                Batal
            </button>

            <a href="/login-admin" class="btn confirm">
                Log Out
            </a>

        </div>

    </div>

</div>

<script src="{{ asset('js/kategori.js') }}"></script>

</body>
</html>