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

function filterKategori(kategori, el = null) {

    let cards = document.querySelectorAll('#bookContainer .book-card');
    let buttons = document.querySelectorAll('.kategori-btn button');

    // reset tombol
    buttons.forEach(btn => btn.classList.remove('active'));

    // tombol active
    if (el) {
        el.classList.add('active');
    }

    // filter buku
    cards.forEach(card => {

        if (kategori === 'all') {

            card.classList.remove('hidden');

        } else if (card.classList.contains(kategori)) {

            card.classList.remove('hidden');

        } else {

            card.classList.add('hidden');

        }

    });

}

// default awal (TANPA event)
window.addEventListener("DOMContentLoaded", () => {
    let firstBtn = document.querySelector('.kategori-btn button');
    filterKategori('all', firstBtn);
});