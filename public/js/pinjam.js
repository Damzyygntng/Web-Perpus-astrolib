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

function openLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "none";
}

const inputs = document.querySelectorAll("input[type='date']");
const btn = document.getElementById("btnPinjam");

inputs.forEach(input => {
  input.addEventListener("input", () => {
    if (inputs[0].value && inputs[1].value) {
      btn.disabled = false;
    } else {
      btn.disabled = true;
    }
  });
});

// =======================
// OPEN MODAL
// =======================
function openLoanModal() {
  const modal = document.getElementById("loanModal");
  if (!modal) return;

  // ambil tanggal dari input
  const inputs = document.querySelectorAll("input[type='date']");
  const pinjam = inputs[0]?.value || "-";
  const kembali = inputs[1]?.value || "-";

  if (!pinjam || !kembali) {
  alert("Tanggal harus diisi dulu!");
  return;
}

if (kembali < pinjam) {
  alert("Tanggal pengembalian tidak boleh sebelum tanggal pinjam!");
  return;
}

const diffTime = new Date(kembali) - new Date(pinjam);
const diffDays = diffTime / (1000 * 60 * 60 * 24);

if (diffDays > 21) {
  alert("Maksimal peminjaman hanya 21 hari!");
  return;
}

  // masukin ke modal
  const elPinjam = document.getElementById("tglPinjam");
  const elKembali = document.getElementById("tglKembali");

  if (elPinjam) elPinjam.innerText = formatTanggal(pinjam);
  if (elKembali) elKembali.innerText = formatTanggal(kembali);

  document.getElementById("inputPinjam").value = pinjam;
  document.getElementById("inputKembali").value = kembali;

  // tampilkan modal
  modal.style.display = "flex";
}


// =======================
// CLOSE MODAL
// =======================
function closeLoanModal() {
  const modal = document.getElementById("loanModal");
  if (modal) modal.style.display = "none";
}


// =======================
// FORMAT TANGGAL BIAR BAGUS
// =======================
function formatTanggal(tgl) {
  if (!tgl || tgl === "-") return "-";

  const bulan = [
    "Januari","Februari","Maret","April","Mei","Juni",
    "Juli","Agustus","September","Oktober","November","Desember"
  ];

  const date = new Date(tgl);

  return `${date.getDate()} ${bulan[date.getMonth()]} ${date.getFullYear()}`;
}


// =======================
// KLIK LUAR MODAL = CLOSE
// =======================
window.addEventListener("click", function(e) {
  const modal = document.getElementById("loanModal");
  if (e.target === modal) {
    modal.style.display = "none";
  }
});


// buka popup success
function openSuccessModal() {
  const modal = document.getElementById("successModal");
  if (modal) {
    modal.style.display = "flex";
  }
}

// tutup popup success
function closeSuccessModal() {
  const modal = document.getElementById("successModal");
  if (modal) {
    modal.style.display = "none";
  }
}

// klik luar popup = close
window.addEventListener("click", function(e) {
  const modal = document.getElementById("successModal");
  if (e.target === modal) {
    closeSuccessModal();
  }
});
