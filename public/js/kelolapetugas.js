const btn = document.getElementById("dropdownBtn");
const menu = document.getElementById("dropdownMenu");
const arrow = btn.querySelector(".arrow");

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

function openLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "none";
}

function openTambah() {

    document.getElementById("modalTambah")
        .style.display = "flex";
}

function closeTambah() {

    document.getElementById("modalTambah")
        .style.display = "none";
}

function openEdit(id, nama, email) {

    document.getElementById("modalEdit")
        .style.display = "flex";

    document.getElementById("editNama")
        .value = nama;

    document.getElementById("editEmail")
        .value = email;

    document.getElementById("formEdit")
        .action = "/petugas/update/" + id;
}

function closeEdit() {

    document.getElementById("modalEdit")
        .style.display = "none";
}

function openHapus(id) {

    document.getElementById("modalHapus")
        .style.display = "flex";

    document.getElementById("formHapus")
        .action = "/petugas/delete/" + id;
}

function closeHapus() {

    document.getElementById("modalHapus")
        .style.display = "none";
}

window.onclick = function(e) {

    const tambah =
        document.getElementById("modalTambah");

    const edit =
        document.getElementById("modalEdit");

    const hapus =
        document.getElementById("modalHapus");

    if (e.target == tambah) {
        tambah.style.display = "none";
    }

    if (e.target == edit) {
        edit.style.display = "none";
    }

    if (e.target == hapus) {
        hapus.style.display = "none";
    }
}