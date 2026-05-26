<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user.css">
    <title>Kelola Buku</title>
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

<li>
  <a href="/kategori">
    <img src="/gambar/kategori.png"> Kelola Kategori
  </a>
</li>

<li>
  <a href="/admin/kelola-buku">
    <img src="/gambar/buku putih.png"> Kelola Buku
  </a>
</li>

<li class="active">
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
  <a href="ulasan">
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
     <li><a href="">Laporan Buku</a></li>
    <li><a href="">Laporan user</a></li>
    <li><a href="laporan_buku.php">Laporan Petugas</a></li>
     <li><a href="laporan_buku.php">Laporan Peminjaman</a></li>
    <li><a href="laporan_buku.php">Laporan Pengembalian</a></li>
  </ul>
</li>

  <div class="logout">
    <li class="menu" onclick="openLogoutPopup()"><img src="/gambar/log out putih.png"> Log Out</li>
  </div>
</div>

  <!-- KONTEN KELOLA USER -->
<div class="content">

  <h2 class="judul-halaman">Kelola User</h2>
  
    <div class="top-bar">
        <button class="btn-tambah" onclick="openTambah()">
            Tambah User
        </button>

        <div class="search-filter">
            <input type="text" placeholder="Cari pengguna..." />
            <button class="btn-filter">Filter</button>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->lokasi }}</td>

                    <td class="aksi">
                        <button class="btn-edit"
                            onclick="openEdit(
                                '{{ $user->id }}',
                                '{{ $user->name }}',
                                '{{ $user->email }}',
                                '{{ $user->lokasi }}'
                            )">
                            Edit
                        </button>

                        <button class="btn-hapus"
                            onclick="openHapus('{{ $user->id }}')">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal" id="modalTambah">
    <div class="popup">
        <div class="popup-header">
            <span>Tambah User</span>
            <button onclick="closeTambah()">✕</button>
        </div>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi">
            </div>

            <div class="popup-footer">
                <button type="button" class="btn-batal"
                    onclick="closeTambah()">
                    Batal
                </button>

                <button type="submit" class="btn-submit">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal" id="modalEdit">
    <div class="popup">
        <div class="popup-header">
            <span>Edit User</span>
            <button onclick="closeEdit()">✕</button>
        </div>

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" id="editNama" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="editEmail" required>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" id="editLokasi">
            </div>

            <div class="popup-footer">
                <button type="button" class="btn-batal"
                    onclick="closeEdit()">
                    Batal
                </button>

                <button type="submit" class="btn-submit">
                    Edit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal" id="modalHapus">
    <div class="popup popup-hapus">

        <div class="popup-header">
            <span>Hapus User</span>
            <button onclick="closeHapus()">✕</button>
        </div>

        <form id="formHapus" method="POST">
            @csrf
            @method('DELETE')

            <div class="hapus-content">
                <div class="icon-hapus">🗑</div>

                <h3>Hapus User?</h3>
                <p>User ini akan dihapus permanen.</p>

                <div class="popup-footer">
                    <button type="button"
                        class="btn-batal"
                        onclick="closeHapus()">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn-hapus2">
                        Hapus
                    </button>
                </div>
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
      <a href="login-admin" class="btn confirm">Log Out</a>
    </div>

  </div>
</div>
<script src="js/user.js"></script>
</body>
</html>