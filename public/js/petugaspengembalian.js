const btn = document.getElementById("dropdownBtn");
const menu = document.getElementById("dropdownMenu");
const arrow = btn.querySelector(".arrow");


// =======================
// DROPDOWN
// =======================

btn.addEventListener("click", (e) => {

  e.stopPropagation();

  if (menu.style.display === "block") {

    menu.style.display = "none";
    arrow.style.transform = "rotate(0deg)";

  } else {

    menu.style.display = "block";
    arrow.style.transform = "rotate(180deg)";
  }
});


document.addEventListener("click", () => {

  menu.style.display = "none";
  arrow.style.transform = "rotate(0deg)";
});


// =======================
// LOGOUT
// =======================

function openLogoutPopup() {

  document.getElementById("logoutPopup")
  .style.display = "flex";
}

function closeLogoutPopup() {

  document.getElementById("logoutPopup")
  .style.display = "none";
}


// =======================
// MODAL TERIMA
// =======================

let currentId = null;

function openTerima(
id,
cover,
judul,
penulis,
nama,
email,
lokasi,
pinjam,
kembali
){

document.getElementById("modalTerima")
.style.display = "flex";

document.getElementById("formTerima").action =
"/admin/pengembalian/terima/" + id;

document.getElementById("terimaCover").src =
cover;

document.getElementById("terimaJudul").innerText =
judul;

document.getElementById("terimaPenulis").innerText =
penulis;

document.getElementById("terimaNama").innerText =
nama;

document.getElementById("terimaEmail").innerText =
email;

document.getElementById("terimaLokasi").innerText =
lokasi;

document.getElementById("terimaPinjam").innerText =
pinjam;

document.getElementById("terimaKembali").innerText =
kembali;



// FORM ACTION
document.getElementById("formTerima").action =
"/admin/pengembalian/terima/" + id;

}

function closeTerima(){

document.getElementById("modalTerima")
.style.display = "none";
}


// =======================
// MODAL TOLAK
// =======================

function openTolak(
    id,
    cover,
    judul,
    penulis,
    nama,
    email,
    lokasi,
    pinjam,
    kembali
){

    document.getElementById("modalTolak")
    .style.display = "flex";

    document.getElementById("tolakCover").src = cover;

    document.getElementById("tolakJudul").innerText = judul;

    document.getElementById("tolakPenulis").innerText = penulis;

    document.getElementById("tolakNama").innerText = nama;

    document.getElementById("tolakEmail").innerText = email;

    document.getElementById("tolakLokasi").innerText = lokasi;

    document.getElementById("tolakPinjam").innerText = pinjam;

    document.getElementById("tolakKembali").innerText = kembali;

    // INI PENTING
    document.getElementById("formTolak").action =
    "/pengembalian/tolak/" + id;
}

function closeTolak(){

    document.getElementById("modalTolak")
    .style.display = "none";

}


// =======================
// CLOSE MODAL KLIK LUAR
// =======================

window.addEventListener("click", function(e){

if(e.target.classList.contains("modal-overlay")){

document.querySelectorAll(".modal-overlay")
.forEach(modal => {

modal.style.display = "none";

});

}

});