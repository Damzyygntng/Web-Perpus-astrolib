function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
}

window.onclick = function(e) {
  if (!e.target.closest('.user-menu')) {
    document.getElementById("userDropdown").style.display = "none";
  }
}

window.onclick = function(e) {
  if (!e.target.closest('.user-menu')) {
    document.getElementById("userDropdown").style.display = "none";
  }
}

function openLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "none";
}

function openDetailPopup(
     cover,
    judul,
    penulis,
    pinjam,
    kembali,
    status,
    alasan
){

    document.getElementById('detailPopup').style.display = 'flex';

    document.getElementById('detailCover').src = cover;
    document.getElementById('detailJudul').innerText = judul;
    document.getElementById('detailPenulis').innerText = penulis;
    document.getElementById('detailPinjam').innerText = pinjam;
    document.getElementById('detailKembali').innerText = kembali;

    let statusText = '';
    let noteText = '';

let statusEl = document.getElementById('detailStatus');

if(status == 'disetujui'){

    statusEl.innerText = 'Disetujui';
    statusEl.style.background = '#DCFCE7';
    statusEl.style.color = '#16A34A';

    document.querySelector('.detail-note').innerText =
    'Peminjaman buku telah disetujui admin.';

}
else if(status == 'ditolak'){

    statusEl.innerText = 'Ditolak';
    statusEl.style.background = '#FEE2E2';
    statusEl.style.color = '#DC2626';

    document.querySelector('.detail-note').innerText =alasan;

}
else{

    statusEl.innerText = 'Menunggu';
    statusEl.style.background = '#FEF3C7';
    statusEl.style.color = '#D97706';

    document.querySelector('.detail-note').innerText =
    'Menunggu konfirmasi admin untuk persetujuan peminjaman buku.';

}
}

function closeDetailPopup(){
    document.getElementById('detailPopup').style.display = 'none';
}