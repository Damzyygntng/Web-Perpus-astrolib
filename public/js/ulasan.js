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

function openHapus(id) {

    document.getElementById("hapusOverlay").style.display = "flex";

    document.getElementById("formHapus").action =
        "/ulasan/delete/" + id;
}

function closeHapus() {

    document.getElementById("hapusOverlay").style.display = "none";
}