const btn = document.getElementById("dropdownBtn");
const menu = document.getElementById("dropdownMenu");
const arrow = btn.querySelector(".arrow");

let currentId = null;

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

document.addEventListener("click", (e) => {
  if (!menu.contains(e.target) && !btn.contains(e.target)) {
    menu.style.display = "none";
    arrow.style.transform = "rotate(0deg)";
  }
});

function openLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "none";
}

const popup = document.getElementById("popup");

function closePopup() {
  popup.classList.remove("show");
}

window.onclick = function(e) {

  if (e.target === popup) {
    closePopup();
  }

  if (e.target === document.getElementById("popupTolak")) {
    closePopupTolak();
  }

};

function openPopup(id, judul, penulis, cover, tglPinjam, tglKembali, nama, email, lokasi) {

  currentId = id;

  popup.classList.add("show");

  document.getElementById("judulBuku").innerText = judul;
  document.getElementById("penulisBuku").innerText = penulis;
  document.getElementById("tglPinjam").innerText = tglPinjam;
  document.getElementById("tglKembali").innerText = tglKembali;
  document.getElementById("namaUser").innerText = nama;
  document.getElementById("emailUser").innerText = email;
  document.getElementById("lokasiUser").innerText = lokasi;

 if (cover && cover !== "") {
  console.log(cover);
  document.getElementById("coverBuku").src = cover;
} else {
  document.getElementById("coverBuku").src = "/gambar/default.png";
}

  document.getElementById("formTerima").action =
"/petugaspinjam/setujui/" + id;
}

document.getElementById("formTerima").addEventListener("submit", function(e) {
    e.preventDefault();

    fetch(this.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            location.reload();
        }
    });
});


function terimaPeminjaman() {

    fetch('/petugaspinjam/setujui/' + currentId, {

        method: 'PUT',

        headers: {

            'X-CSRF-TOKEN':
            document.querySelector('meta[name="csrf-token"]').content,

            'Accept': 'application/json'
        }

    })

    .then(response => response.json())

    .then(data => {

        location.reload();

    });

}

function openPopupTolak(
    id,
    judul,
    penulis,
    cover,
    tglPinjam,
    tglKembali,
    nama,
    email,
    lokasi
){
    popup.classList.remove("show");

    currentId = id;

    document.getElementById("popupTolak").style.display = "flex";

    document.getElementById("judulBukuTolak").innerText = judul;
    document.getElementById("penulisBukuTolak").innerText = penulis;

    document.getElementById("coverBukuTolak").src = cover;

    document.getElementById("tglPinjamTolak").innerText = tglPinjam;
    document.getElementById("tglKembaliTolak").innerText = tglKembali;
    document.getElementById("namaUserTolak").innerText = nama;
    document.getElementById("emailUserTolak").innerText = email;
    document.getElementById("lokasiUserTolak").innerText = lokasi;
}

function closePopupTolak(){
    document.getElementById("popupTolak").style.display = "none";
}


function kirimPenolakan() {

    let alasan =
    document.getElementById("alasanPenolakan").value;

    fetch('/petugaspinjam/tolak/' + currentId, {

        method: 'PUT',

        headers: {

            'X-CSRF-TOKEN':
            document.querySelector(
                'meta[name="csrf-token"]'
            ).content,

            'Accept': 'application/json',

            'Content-Type': 'application/json'
        },

        body: JSON.stringify({

            alasan_penolakan: alasan

        })

    })

    .then(response => response.json())

    .then(data => {

        location.reload();

    });

}
