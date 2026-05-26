<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/generatebuku.css') }}">
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

<li>
 <a href="/petugas/pengembalian">
    <img src="/gambar/book (1).png"> Peminjaman
  </a>
</li>

<li>
  <a href="/admin/pengembalian">
    <img src="/gambar/trade.png"> Pengembalian
  </a>
</li>

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

    <div class="card-laporan">

        <div class="header-laporan">

            <div>
                <h2>Laporan Data Buku</h2>
                <p>Kelola dan generate data buku</p>
            </div>

            <button class="btn-cetak" onclick="openModal()">
                Cetak Laporan
            </button>

        </div>

        <table class="table-laporan">

            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Tersedia</th>
                    <th>Dipinjam</th>
                    <th>Tanggal Ditambahkan</th>
                </tr>
            </thead>

            <tbody>

                @foreach($bukus as $buku)

                <tr>

                    <td>
                       <img src="{{ asset(
    str_contains($buku->cover, 'gambar/')
    ? $buku->cover
    : 'gambar/' . $buku->cover
) }}" class="cover">
                    </td>

                    <td class="judul-buku">
                        {{ $buku->judul }}
                    </td>

                    <td>
                        {{ $buku->penulis }}
                    </td>

                    <td>
                        {{ $buku->stok }}
                    </td>

                    <td>
                        {{ $buku->stok }}
                    </td>

                    <td>
                        {{ $buku->dipinjam ?? 0 }}
                    </td>

                    <td>
                        {{ $buku->created_at->format('d/m/Y') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


    <!-- MODAL -->

    <div class="modal" id="popupCetak">
        <div class="modal-content">

            <div class="modal-header">
                Cetak Laporan
            </div>

            <div class="modal-body">
                <i>📄</i>
                <h3>Cetak Laporan</h3>
                <p>Anda yakin ingin mencetak laporan ini?</p>
            </div>

            <div class="modal-footer">
                <button class="btn-batal" onclick="closeModal()">
                    Batal
                </button>

                <a href="{{ route('laporan.buku.cetak') }}">
                    <button class="btn-yes">
                        Cetak
                    </button>
                </a>
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
<script src="{{ asset('js/generatebuku.js') }}"></script>
</body>
</html>