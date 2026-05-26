<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AstroLib</title>
    <link rel="stylesheet" href="css/login.css">
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
           @if(session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
    @endif
    <h2>Login Ke AstroLib</h2>
    <p>Lanjutkan Petualangan Membacamu</p>

    <form action="/login" method="POST">
      @csrf
      <div class="input-group">
        <img src="/gambar/email.png">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <img src="/gambar/lock.png">
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button class="login-btn">Login</button>

      <div class="register">
        Belum punya akun? <a href="/register">Daftar</a>
      </div>

    </form>
  </div>
    </div>
</body>
</html>