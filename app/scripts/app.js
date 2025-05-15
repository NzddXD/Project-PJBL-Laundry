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

function confirmDelete(id) {
  console.log("confirmDelete function yield!");
  deleteButton.style.display = "block";
  closeButton.textContent = "Batal";
  popup.style.display = "flex";
  titleText.textContent = "Hapus Data?";
  messageText.textContent =
    "Apakah Anda yakin ingin menghapus data pelanggan ini?";

  deleteButton.onclick = function () {
    window.location.href = "../../funcs/deletePelanggan.php?id=" + id;
  };
}

// Popup w/ hidden delete button
function hidePopup() {
  closeButton.onclick = function () {
    window.location.href = "../../app/admin/customer.php";
  };
}

function updated() {
  console.log("updated() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Berhasil!";
  messageText.textContent = "Data telah berhasil diupdate.";

  hidePopup();

}

function deleted() {
  console.log("deleted() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Dihapus!";
  messageText.textContent = "Data berhasil dihapus.";

  hidePopup();
}

function errorOnDelete() {
  console.log("errorOnDelete() function yield!");
  deleteButton.style.display = "none";
  closeButton.textContent = "Tutup";
  popup.style.display = "flex";
  titleText.textContent = "Kesalahan!";
  messageText.textContent = "Terjadi kesalahan saat menghapus data.";

  hidePopup();
}
