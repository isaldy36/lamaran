// Validasi sederhana untuk form kontak
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('formKontak');
  const notifikasi = document.getElementById('notifikasi');

  if (form) {
    form.addEventListener('submit', function (e) {
      const nama = document.getElementById('nama').value.trim();
      const email = document.getElementById('email').value.trim();
      const pesan = document.getElementById('pesan').value.trim();

      // Validasi kosong
      if (!nama || !email || !pesan) {
        e.preventDefault();
        notifikasi.textContent = 'Semua kolom wajib diisi.';
        notifikasi.style.color = 'red';
        return;
      }

      // Validasi email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        e.preventDefault();
        notifikasi.textContent = 'Format email tidak valid.';
        notifikasi.style.color = 'red';
        return;
      }

      // Lolos validasi
      notifikasi.textContent = 'Mengirim pesan...';
      notifikasi.style.color = 'black';
    });
  }
});
