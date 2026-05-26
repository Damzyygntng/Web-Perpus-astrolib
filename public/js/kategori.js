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
    document.getElementById("modalTambah").style.display = "flex";
}

function closeTambah() {
    document.getElementById("modalTambah").style.display = "none";
}

function openEdit(id, nama) {

    document.getElementById("modalEdit").style.display = "flex";

    document.getElementById("editKategori").value = nama;

    document.getElementById("formEdit").action =
        "/kategori/update/" + id;
}

function closeEdit() {
    document.getElementById("modalEdit").style.display = "none";
}

function openHapus(id) {

    document.getElementById("modalHapus").style.display = "flex";

    document.getElementById("formHapus").action =
        "/kategori/delete/" + id;
}

function closeHapus() {
    document.getElementById("modalHapus").style.display = "none";
}