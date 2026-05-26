<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register AstroLib</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="header">
        <div class="frame">
            <img class="gambar" src="/gambar/fotologin.png"/>
        </div>
        <img class="Logo" src="/gambar/logo.png" alt="Astrolib Logo">
        <div class="judul">
            Temukan Dunia Buku , <br> Jelajahi
        </div>
        <div class="subjudul">Tanpa Batas</div>
        <div class="subtext">AstroLib hadir untuk menemani setiap <br> petualangan membaca kamu.
    </div>
        <div class="login-card">
    <h2>Buat akun baru</h2>
    <p>Mulai perjalanan membaca kamu</p>

    <form action="/register" method="POST">
      @csrf
        <div class="input-group">
        <img src="/gambar/nama.png">
        <input type="text" name="name" placeholder="Nama lengkap" required>
      </div>

      <div class="input-group">
        <img src="/gambar/email.png">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <img src="/gambar/lock.png">
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="input-group">
        <img src="/gambar/lokasi.png">
        <input type="text" name="lokasi" placeholder="Lokasi (Khusus Daerah Jabodetabek) " required>
      </div>

      <button class="login-btn">Daftar</button>

      <div class="register">
        Sudah punya akun? <a href="/login">Login</a>
      </div>

      <div id="popupError" class="popup">
  <div class="popup-content">
    <h3>Akses Ditolak</h3>
    <p id="popupMessage">Website ini hanya untuk wilayah Jabodetabek</p>
    <button onclick="closePopup()">Oke</button>
  </div>
</div>
    </form>
    @if ($errors->has('lokasi'))
<script>
    window.onload = function() {
        showPopup("{{ $errors->first('lokasi') }}");
    }
</script>
@endif
  </div>
    </div>
    <script src="js/regis.js"></script>
</body>
</html>