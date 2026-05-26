<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Bukti Pengembalian</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f2f5fb;
    display:flex;
    justify-content:center;
    padding:40px 20px;
}

.container{
    width:750px;
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:30px;
}

.top h1{
    font-size:32px;
    font-weight:700;
    color:#111827;
}

.top p{
    color:#6b7280;
    margin-top:8px;
    line-height:1.6;
}

.logo{
    font-size:28px;
    font-weight:700;
    color:#2563eb;
}

.line{
    border-top:2px dashed #d1d5db;
    margin:30px 0;
}

.section{
    margin-bottom:35px;
}

.section h2{
    font-size:26px;
    margin-bottom:25px;
    color:#111827;
}

.info-grid{
    display:grid;
    grid-template-columns:160px 1fr;
    gap:16px;
}

.label{
    color:#6b7280;
}

.value{
    font-weight:500;
    color:#111827;
}

.book{
    display:flex;
    gap:25px;
}

.book img{
    width:130px;
    height:190px;
    border-radius:14px;
    object-fit:cover;
}

.book-info{
    flex:1;
}

.book-item{
    display:grid;
    grid-template-columns:120px 1fr;
    margin-bottom:16px;
}

.detail-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.detail-card span{
    font-size:14px;
    color:#6b7280;
}

.detail-card h3{
    margin-top:8px;
    font-size:18px;
    color:#111827;
}

.status{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#dcfce7;
    color:#16a34a;
    padding:10px 18px;
    border-radius:999px;
    font-size:14px;
    font-weight:600;
}

.note{
    margin-top:35px;
    background:#eef4ff;
    border-radius:18px;
    padding:22px;
    display:flex;
    gap:15px;
    align-items:flex-start;
}

.note-icon{
    font-size:28px;
    color:#2563eb;
}

.note p{
    color:#4b5563;
    line-height:1.6;
}

.footer{
    margin-top:40px;
    text-align:center;
    color:#9ca3af;
    font-size:14px;
}

.footer span{
    color:#2563eb;
    font-weight:600;
}

.print-btn{
    margin-top:35px;
    width:100%;
    height:55px;
    border:none;
    border-radius:16px;
    background:#2563eb;
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
}

@media print{

    body{
        background:white;
        padding:0;
    }

    .print-btn{
        display:none;
    }

    .container{
        box-shadow:none;
        width:100%;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="top">
        <div>
            <h1>Bukti Pengembalian</h1>

            <p>
                Buku telah berhasil sampai ke orbitnya <br>
                jangan lupa petualangan berikutnya ya!
            </p>
        </div>

        <div class="logo">
            AstroLib
        </div>
    </div>

    <div class="line"></div>

    <!-- DATA USER -->
    <div class="section">

        <h2>Data Peminjam</h2>

        <div class="info-grid">

            <div class="label">Nama</div>
            <div class="value">{{ $pinjam->user->name }}</div>

            <div class="label">Email</div>
            <div class="value">{{ $pinjam->user->email }}</div>

            <div class="label">Lokasi</div>
            <div class="value">{{ $pinjam->user->alamat ?? 'Jakarta' }}</div>

        </div>

    </div>

    <div class="line"></div>

    <!-- DATA BUKU -->
    <div class="section">

        <h2>Data Buku</h2>

        <div class="book">

           <img src="{{ asset($pinjam->buku->cover) }}">

            <div class="book-info">

                <div class="book-item">
                    <div class="label">Judul</div>
                    <div class="value">{{ $pinjam->buku->judul }}</div>
                </div>

                <div class="book-item">
                    <div class="label">Penulis</div>
                    <div class="value">{{ $pinjam->buku->penulis }}</div>
                </div>

                <div class="book-item">
                    <div class="label">Penerbit</div>
                    <div class="value">{{ $pinjam->buku->penerbit }}</div>
                </div>

            </div>

        </div>

    </div>

    <div class="line"></div>

    <!-- DETAIL -->
    <div class="section">

        <h2>Detail Peminjaman</h2>

        <div class="detail-grid">

            <div class="detail-card">
                <span>Tanggal Pinjam</span>
                <h3>
                    {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->translatedFormat('d F Y') }}
                </h3>
            </div>

            <div class="detail-card">
                <span>Tanggal Kembali</span>
                <h3>
                    {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->translatedFormat('d F Y') }}
                </h3>
            </div>

            <div class="detail-card">
                <span>Petugas</span>
                <h3>

                    @if(Auth::user()->role == 'admin')
                        Admin
                    @else
                        Petugas
                    @endif

                </h3>
            </div>

            <div class="detail-card">
                <span>Status</span>

                <div class="status">
                    ✓ Disetujui
                </div>
            </div>

        </div>

    </div>

    <!-- NOTE -->
    <div class="note">

        <div class="note-icon">
            ⓘ
        </div>

        <p>
            Buku telah berhasil sampai ke orbitnya
            jangan lupa petualangan berikutnya ya!
        </p>

    </div>

    <div class="footer">
        Terima kasih telah <span>menggunakan AstroLib.</span>
    </div>

    <button onclick="window.print()" class="print-btn">
        Cetak Bukti
    </button>

</div>
<script>
    window.print();
</script>
</body>
</html>