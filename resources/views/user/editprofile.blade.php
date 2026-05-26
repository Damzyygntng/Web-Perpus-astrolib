<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit Profile</title>
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

    <a href="/pengembalian" class="user-item">
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
                    <h3>0</h3>
                    <p>Sedang di pinjam</p>
                </div>
            </div>

            <div class="box">
                <img src="/gambar/time.png">
                <div>
                    <h3>0</h3>
                    <p>Riwayat Peminjaman</p>
                </div>
            </div>
        </div>


    </div>


    <div class="profile-container">
@if(session('success'))
    <div class="toast" id="toast">
        {{ session('success') }}
    </div>
@endif
    <!-- LEFT: EDIT PROFILE -->
   <form action="{{ route('profile.update') }}" method="POST" class="card">
    @csrf

    <h3>Edit Profile</h3>
    <p class="desc">Perbarui informasi profil Anda dibawah ini.</p>

    <div class="photo-section">
        <img src="{{ Auth::user()->photo ? asset('storage/uploads/' . Auth::user()->photo) : '/gambar/man (1).png' }}">
        <button type="button" class="btn-outline" onclick="openPopup()">
            <img src="/gambar/download.png" alt="">
            Ganti Foto
        </button>
        <small>PNG, JPG maksimal 2MB</small>
    </div>

    <label>Nama Lengkap</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}">

    <label>Email</label>
    <input type="email" name="email" value="{{ Auth::user()->email }}">

    <label>Lokasi</label>
    <input type="text" name="lokasi" value="{{ Auth::user()->lokasi }}">

    <div class="btn-group">
        <button type="button" class="btn-cancel" onclick="history.back()">Batal</button>
        <button type="submit" class="btn-primary">Simpan Perubahan</button>
    </div>
</form>

    <!-- RIGHT: CHANGE PASSWORD -->
    <form action="{{ route('password.update') }}" method="POST" class="card">
    @csrf

    <h3>Ganti Password</h3>
    <p class="desc">Kosongkan jika tidak ingin mengganti password</p>

    <label>Password Saat ini</label>
    <div class="password-box">
    <input type="password" id="current_password" name="current_password">
                <img src="/gambar/view.png" 
                    id="eyeIcon"
                    class="eye-icon"
                    onclick="togglePassword()">
            </div>

    <label>Password Baru</label>
    <div class="password-box">
  <input type="password" name="new_password">
                <img src="/gambar/view.png" 
                    id="eyeIcon"
                    class="eye-icon"
                    onclick="togglePassword()">
            </div>

    <label>Konfirmasi Password Baru</label>
    <div class="password-box">
    <input type="password" name="new_password_confirmation">
                <img src="/gambar/view.png" 
                    id="eyeIcon"
                    class="eye-icon"
                    onclick="togglePassword()">
            </div>

    <div class="btn-right">
        <button type="submit" class="btn-primary">Perbarui Password</button>
    </div>
</form>

<div id="popupFoto" class="popup">

    <div class="popup-content">
        <h3>Ubah Foto Profile</h3>
        <p>Pilih foto baru untuk profile anda</p>

        <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- UPLOAD -->
            <label class="upload-box" onclick="document.getElementById('fileInput').click()">
                <img src="/gambar/awan.png">
                <span>Klik untuk upload</span>
                <input type="file" name="photo" id="fileInput" hidden>
            </label>

            <!-- PREVIEW -->
            <img id="preview" style="display:none; width:80px; margin-top:10px; border-radius:50%;">

            <small>PNG, JPG maksimal 2MB</small>

            <!-- BUTTON -->
            <div class="popup-btn">
                <button type="button" onclick="closePopup()" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-primary">Simpan Foto</button>
            </div>
        </form>

    </div>

</div>
    <script src="js/edit.js"></script>
</body>
</html>