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