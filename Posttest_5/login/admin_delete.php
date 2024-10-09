<?php
include 'config.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    // Hapus file gambar yang terkait dengan buku
    $result = $conn->query("SELECT image FROM buku WHERE isbn='$isbn'");
    $row = $result->fetch_assoc();
    $image = $row['image'];
    
    if (file_exists("book/$image")) {
        unlink("book/$image"); // Hapus gambar dari folder
    }

    // Hapus data buku dari database
    $sql = "DELETE FROM buku WHERE isbn='$isbn'";

    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil dihapus!";
        header("Location: admin_dashboard.php"); // Redirect ke halaman utama
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
