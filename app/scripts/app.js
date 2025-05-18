// Popup close system (temporary solution)
const popup = document.querySelector(".popup");
const titleText = document.getElementById("titleText");
const messageText = document.getElementById("messageText");
const deleteButton = document.querySelector(".delete-button");
const closeButton = document.querySelector(".close-popup");

// Initial popup state
popup.style.display = "none";

function closePopup() {
  popup.style.display = "none";
}

function success() {
  console.log("success function yield!");
  popup.style.display = "flex";
  titleText.textContent = "Berhasil!";
  messageText.textContent = "Data berhasil disimpan.";
}
function invalid() {
  console.log("invalid function yield!");
  popup.style.display = "flex";
  titleText.textContent = "Kesalahan!";
  messageText.textContent = "Metode POST tidak tersedia.";
}
function duplicate() {
  console.log("duplicate function yield!");
  popup.style.display = "flex";
  titleText.textContent = "Data Duplikat!";
  messageText.textContent = "Data yang dimassukan sudah ada.";
}
function error() {
  console.log("error function yield!");
  popup.style.display = "flex";
  titleText.textContent = "Error!";
  messageText.textContent = "Terjadi kesalahan saat menyimpan data.";
}

function confirmDelete(funcPath, id) {
  console.log("confirmDelete function yield!");
  deleteButton.style.display = "block";
  closeButton.textContent = "Batal";
  popup.style.display = "flex";
  titleText.textContent = "Hapus Data?";
  messageText.textContent =
    "Apakah Anda yakin ingin menghapus data pelanggan ini?";

  deleteButton.onclick = function () {
    window.location.href = "../../funcs/" + funcPath + "?id=" + id;
  };
}

// Popup w/ hidden delete button
function hidePopup(goto) {
  closeButton.onclick = function () {
    window.location.href = goto;
  };
}

function updated(goto) {
  console.log("updated() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Berhasil!";
  messageText.textContent = "Data telah berhasil diupdate.";
  
  hidePopup(goto);
}

function deleted(goto) {
  console.log("deleted() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Dihapus!";
  messageText.textContent = "Data berhasil dihapus.";

  hidePopup(goto);
}

function errorOnDelete(goto) {
  console.log("errorOnDelete() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Kesalahan!";
  messageText.textContent = "Terjadi kesalahan saat menghapus data.";

  hidePopup(goto);
}
