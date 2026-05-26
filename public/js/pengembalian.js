function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");

  dropdown.style.display =
    dropdown.style.display === "block"
    ? "none"
    : "block";
}


// LOGOUT
function openLogoutPopup() {

  document.getElementById("logoutPopup")
  .style.display = "flex";
}

function closeLogoutPopup() {

  document.getElementById("logoutPopup")
  .style.display = "none";
}


// =========================
// MODAL PENGEMBALIAN
// =========================

let currentId = null;

function openModal(
id,
cover,
judul,
penulis,
pinjam,
kembali
){

    currentId = id;

    document.getElementById("modalPengembalian")
    .style.display = "flex";

    document.getElementById("modalCover").src =
    cover;

    document.getElementById("modalJudul").innerText =
    judul;

    document.getElementById("modalPenulis").innerText =
    penulis;

    document.getElementById("modalPinjam").innerText =
    pinjam;

    document.getElementById("modalKembali").innerText =
    kembali;
}

function closeModal(){

    document.getElementById("modalPengembalian")
    .style.display = "none";
}


// =========================
// SUBMIT PENGEMBALIAN
// =========================

function submitPengembalian(){

    fetch('/pengembalian/konfirmasi/' + currentId, {

        method: 'POST',

        headers: {

            'X-CSRF-TOKEN':
            document.querySelector(
                'meta[name="csrf-token"]'
            ).content,

            'Accept': 'application/json'
        }

    })

    .then(response => response.json())

    .then(data => {

        closeModal();

        document.getElementById("successModal")
        .style.display = "flex";

        setTimeout(() => {

            location.reload();

        }, 1800);

    })

    .catch(error => {

        console.log(error);

        alert("Terjadi kesalahan");

    });
}


// =========================
// SUCCESS MODAL
// =========================

function closeSuccess(){

    document.getElementById("successModal")
    .style.display = "none";
}


// =========================
// DETAIL MODAL
// =========================

function openDetailModal(
cover,
judul,
penulis,
pinjam,
kembali
){

    document.getElementById("detailModal")
    .style.display = "flex";

    document.getElementById("detailCover").src =
    cover;

    document.getElementById("detailJudul").innerText =
    judul;

    document.getElementById("detailPenulis").innerText =
    penulis;

    document.getElementById("detailPinjam").innerText =
    pinjam;

    document.getElementById("detailKembali").innerText =
    kembali;
}

function closeDetailModal(){

    document.getElementById("detailModal")
    .style.display = "none";
}


// =========================
// GLOBAL CLICK
// =========================

window.addEventListener("click", function(e){

    // tutup dropdown
    if (!e.target.closest('.user-menu')) {

        const dropdown =
        document.getElementById("userDropdown");

        if(dropdown){
            dropdown.style.display = "none";
        }
    }

    // tutup modal kalau klik bg
    if(
        e.target.classList.contains('modal-bg')
    ){

        document.querySelectorAll('.modal-bg')
        .forEach(modal => {

            modal.style.display = "none";

        });
    }

});

function openDetail() {
    document.getElementById('modalDetail').style.display = 'flex';
}

function closeDetail() {
    document.getElementById('modalDetail').style.display = 'none';
}

function openTolakModal(
id,
cover,
judul,
penulis,
pinjam,
deadline,
alasan
){

    document.getElementById("tolakModal").style.display = "flex";

    document.getElementById("tolakCover").src = cover;
    document.getElementById("tolakJudul").innerText = judul;
    document.getElementById("tolakPenulis").innerText = penulis;
    document.getElementById("tolakPinjam").innerText = pinjam;
    document.getElementById("tolakDeadline").innerText = deadline;
    document.getElementById("tolakAlasan").innerText = alasan;

    document.getElementById("btnAjukanLagi").href =
    "/ajukan-pengembalian/" + id;
}

function closeTolakModal(){

    document.getElementById("tolakModal")
    .style.display = "none";

}

window.addEventListener("click", function(e){

    const modal =
    document.getElementById("tolakModal");

    if(e.target === modal){

        closeTolakModal();

    }

});

