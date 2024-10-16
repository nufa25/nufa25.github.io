<?php
$server = "localhost";
$user = "root";
$pass = "gakingat";
$db = "publisher_schema";

$conn = mysqli_connect($server, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
