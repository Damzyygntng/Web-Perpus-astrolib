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

function openModal() {
    document.getElementById("modalCetak").style.display = "flex";
}

function closeModal() {
    document.getElementById("modalCetak").style.display = "none";
}

window.onclick = function(event) {

    let modal = document.getElementById("modalCetak");

    if (event.target == modal) {
        modal.style.display = "none";
    }
}


