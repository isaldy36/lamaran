<?php
// Konfigurasi database
$host = "localhost";
$user = "root";
$password = "";
$database = "portofolio_db";

// Koneksi ke database
$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

// Tangkap data dari form
$nama  = htmlspecialchars($_POST['nama']);
$email = htmlspecialchars($_POST['email']);
$pesan = htmlspecialchars($_POST['pesan']);

// Validasi sederhana
if (empty($nama) || empty($email) || empty($pesan)) {
  echo "Semua data wajib diisi.";
  exit;
}

// Simpan ke database
$stmt = $koneksi->prepare("INSERT INTO kontak (nama, email, pesan, tanggal) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $nama, $email, $pesan);

if ($stmt->execute()) {
  echo "Pesan berhasil dikirim. Terima kasih!";
} else {
  echo "Terjadi kesalahan: " . $stmt->error;
}

if ($stmt->execute()) {
  header("Location: ../kontak.html?status=sukses");
  exit;
} else {
  echo "Terjadi kesalahan: " . $stmt->error;
}
// Kirim email ke admin
$to = "aljanuisaldy@gmail.com"; // Ganti dengan emailmu
$subject = "Pesan Baru dari $nama";
$message = "Nama: $nama\nEmail: $email\nPesan:\n$pesan";
$headers = "From: noreply@namamu.com";

mail($to, $subject, $message, $headers);

$stmt->close();
$koneksi->close();
?>
