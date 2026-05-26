function showPopup(message) {
    document.getElementById("popupMessage").innerText = message;
    document.getElementById("popupError").style.display = "flex";
}

function closePopup() {
    document.getElementById("popupError").style.display = "none";
}