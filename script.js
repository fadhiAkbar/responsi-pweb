// ============================================================
// Validasi form pembelian — murni JavaScript native, tanpa alert()
// ============================================================

document.addEventListener("DOMContentLoaded", function () {
  const form       = document.getElementById("form-beli");
  const inputNama  = document.getElementById("nama_pemain");
  const inputEmail = document.getElementById("email");
  const selectNinja= document.getElementById("ninja_pilihan");
  const inputKoin  = document.getElementById("jumlah_koin");

  const errNama  = document.getElementById("error-nama");
  const errEmail = document.getElementById("error-email");
  const errNinja = document.getElementById("error-ninja");
  const errKoin  = document.getElementById("error-koin");

  // Data harga ninja (dikirim dari PHP lewat tag <script type="application/json">)
  const dataHarga = JSON.parse(document.getElementById("ninja-data").textContent);

  function tampilkanError(elError, elInput, pesan) {
    elError.textContent = pesan;
    elInput.classList.add("invalid");
  }

  function bersihkanError(elError, elInput) {
    elError.textContent = "";
    elInput.classList.remove("invalid");
  }

  function validasiNama() {
    const nilai = inputNama.value.trim();
    if (nilai === "") {
      tampilkanError(errNama, inputNama, "Nama pemain wajib diisi.");
      return false;
    }
    bersihkanError(errNama, inputNama);
    return true;
  }

  function validasiEmail() {
    const nilai = inputEmail.value.trim();
    const polaEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (nilai === "") {
      tampilkanError(errEmail, inputEmail, "Email wajib diisi.");
      return false;
    }
    if (!polaEmail.test(nilai)) {
      tampilkanError(errEmail, inputEmail, "Format email tidak valid.");
      return false;
    }
    bersihkanError(errEmail, inputEmail);
    return true;
  }

  function validasiKoin() {
    const nilaiMentah = inputKoin.value.trim().replace(/\./g, "").replace(/,/g, "");
    const ninjaId = selectNinja.value;
    const hargaMinimal = dataHarga[ninjaId];

    if (nilaiMentah === "") {
      tampilkanError(errKoin, inputKoin, "Jumlah koin wajib diisi.");
      return false;
    }
    if (!/^\d+$/.test(nilaiMentah)) {
      tampilkanError(errKoin, inputKoin, "Jumlah koin harus berupa angka.");
      return false;
    }

    const nilaiAngka = parseInt(nilaiMentah, 10);
    if (nilaiAngka < hargaMinimal) {
      tampilkanError(
        errKoin,
        inputKoin,
        "Koin kurang! Minimal Rp " + hargaMinimal.toLocaleString("id-ID") + " untuk ninja ini."
      );
      return false;
    }

    bersihkanError(errKoin, inputKoin);
    return true;
  }

  function validasiNinja() {
    if (!selectNinja.value) {
      tampilkanError(errNinja, selectNinja, "Pilih salah satu ninja.");
      return false;
    }
    bersihkanError(errNinja, selectNinja);
    return true;
  }

  // validasi realtime saat mengetik / memilih
  inputNama.addEventListener("input", validasiNama);
  inputEmail.addEventListener("input", validasiEmail);
  selectNinja.addEventListener("change", function () {
    validasiNinja();
    validasiKoin();
  });
  inputKoin.addEventListener("input", validasiKoin);

  // validasi final saat submit
  form.addEventListener("submit", function (event) {
    const namaValid  = validasiNama();
    const emailValid = validasiEmail();
    const ninjaValid = validasiNinja();
    const koinValid  = validasiKoin();

    if (!(namaValid && emailValid && ninjaValid && koinValid)) {
      event.preventDefault();
    }
  });
});
