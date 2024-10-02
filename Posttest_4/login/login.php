<?php
// Simulasi data pengguna
$user = [
    'admin' => 'mizanpublisher'
];

// Ambil data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek apakah username dan password sesuai
if (isset($user[$username]) && $user[$username] === $password) {
    echo "Login berhasil! Selamat datang, " . htmlspecialchars($username);
} else {
    echo "Login gagal! Username atau password salah.";
}
?>
