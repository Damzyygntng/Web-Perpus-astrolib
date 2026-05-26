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

function openPopup() {
    document.getElementById("popupFoto").style.display = "flex";
}

function closePopup() {
    document.getElementById("popupFoto").style.display = "none";
}

setTimeout(() => {
    let toast = document.getElementById('toast');
    if(toast) toast.style.display = 'none';
}, 3000);

function togglePassword() {
    let input = document.getElementById("current_password");
    let icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.src = "/gambar/hide.png"; // icon mata tertutup
    } else {
        input.type = "password";
        icon.src = "/gambar/view.png"; // icon mata biasa
    }
}
