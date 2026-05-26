const btn = document.getElementById("dropdownBtn");
const menu = document.getElementById("dropdownMenu");

if(btn && menu){

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
}

function openLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup() {
  document.getElementById("logoutPopup").style.display = "none";
}

const modal = document.getElementById("modalForm");
const deleteModal = document.getElementById("modalDelete");

function openTambah(){

    document.getElementById("modalForm").style.display = "flex";

    document.getElementById("judulModal").innerText = "Tambah Buku";

    document.getElementById("formBuku").reset();

    document.getElementById("formBuku").action =
    "/petugas/kelolabuku";

    let method = document.getElementById("_method");

    if(method){
        method.remove();
    }

    document.getElementById("preview").innerHTML =
    "Upload Cover";
}

function closeModal(){
    document.getElementById("modalForm").style.display = "none";
}

function closeDelete(){
    document.getElementById("modalDelete").style.display = "none";
}

function openEdit(
id,
judul,
penulis,
kategori,
penerbit,
tahun,
isbn,
halaman,
stok,
sinopsis
){

    document.getElementById("modalForm").style.display = "flex";

    document.getElementById("judulModal").innerText = "Edit Buku";

    document.getElementById("formBuku").action =
"/petugas/kelolabuku/update/" + id;

    document.getElementById("judul").value = judul;
    document.getElementById("penulis").value = penulis;
    document.getElementById("kategori").value = kategori;
    document.getElementById("penerbit").value = penerbit;
    document.getElementById("tahun").value = tahun;
    document.getElementById("isbn").value = isbn;
    document.getElementById("halaman").value = halaman;
    document.getElementById("stok").value = stok;
    document.getElementById("sinopsis").value = sinopsis;

    if (!document.getElementById("_method")) {

        let method = document.createElement("input");

        method.type = "hidden";
        method.name = "_method";
        method.value = "PUT";
        method.id = "_method";

        document.getElementById("formBuku").appendChild(method);
    }
}

function openDelete(id){

    deleteModal.style.display = "flex";

    document.getElementById("formDelete").action =
    "/petugas/kelolabuku/delete/" + id;
}

function closeDelete(){
    deleteModal.style.display = "none";
}

const coverInput = document.getElementById("cover");

if(coverInput){

    coverInput.addEventListener("change", function(e){

        const file = e.target.files[0];

        if(file){

            const reader = new FileReader();

            reader.onload = function(a){

                document.getElementById("preview").innerHTML =
                `<img src="${a.target.result}">`;
            }

            reader.readAsDataURL(file);
        }
    });
}

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(a){

            document.getElementById("preview").innerHTML =
            `<img src="${a.target.result}">`;
        }

        reader.readAsDataURL(file);
    }

window.onclick = function(e){

    if(e.target == modal){
        closeModal();
    }

    if(e.target == deleteModal){
        closeDelete();
    }
}