<?php
include 'config.php';

// Ambil data buku berdasarkan ISBN
if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $result = $conn->query("SELECT * FROM buku WHERE isbn='$isbn'");
    $row = $result->fetch_assoc();
}

// Menangani pembaruan data buku
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    $language = $_POST['language'];
    $genre = $_POST['genre'];
    $page_count = $_POST['page_count'];
    $book_type = $_POST['book_type'];
    $publish_date = $_POST['publish_date'];
    $author = $_POST['author'];
    $biography = $_POST['biography'];

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $old_image = $_POST['old_image'];

    if ($image) {
        // Cek ukuran file (maksimum 2MB)
        if ($image_size > 2 * 1024 * 1024) {
            echo "Ukuran file terlalu besar. Maksimum 2MB.";
        } else {
            // Hapus gambar lama
            if (file_exists("book/$old_image")) {
                unlink("book/$old_image");
            }

            // Membuat nama file baru dengan format waktu upload
            $image_extension = pathinfo($image, PATHINFO_EXTENSION);
            $upload_time = date('Y-m-d H.i.s'); // Mendapatkan waktu upload
            $new_image_name = $upload_time . '.' . $image_extension;
            $target = "book/" . basename($new_image_name);

            // Upload gambar baru
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

            // Menggunakan nama file baru untuk disimpan ke database
            $image = $new_image_name;
        }
    } else {
        // Jika gambar tidak diupload, tetap gunakan gambar lama
        $image = $old_image;
    }

    // Update data di database
    $sql = "UPDATE buku SET title='$title', synopsis='$synopsis', image='$image', language='$language', genre='$genre', pages_count='$page_count', book_type='$book_type', publish_date='$publish_date', author='$author', biography='$biography' WHERE isbn='$isbn'";

    if ($conn->query($sql) === TRUE) {
        echo "Data buku berhasil diperbarui!";
        header("Location: admin_dashboard.php"); // Redirect ke halaman utama
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Edit Buku</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="isbn" value="<?= $row['isbn'] ?>">
        <input type="hidden" name="old_image" value="<?= $row['image'] ?>">

        <label for="title">Judul:</label>
        <input type="text" name="title" value="<?= $row['title'] ?>" required><br>

        <label for="synopsis">Sinopsis:</label>
        <textarea name="synopsis"><?= $row['synopsis'] ?></textarea><br>

        <label for="image">Gambar (kosongkan jika tidak ingin mengubah):</label>
        <input type="file" name="image"><br>
        <img src="book/<?= $row['image'] ?>" width="100"><br>

        <label for="language">Bahasa:</label>
        <input type="text" name="language" value="<?= $row['language'] ?>" required><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?= $row['genre'] ?>" required><br>

        <label for="page_count">Jumlah Halaman:</label>
        <input type="number" name="page_count" value="<?= $row['pages_count'] ?>" required><br>

        <label for="book_type">Jenis Buku:</label>
        <input type="text" name="book_type" value="<?= $row['book_type'] ?>" required><br>

        <label for="publish_date">Tanggal Terbit:</label>
        <input type="date" name="publish_date" value="<?= $row['publish_date'] ?>" required><br>

        <label for="author">Penulis:</label>
        <input type="text" name="author" value="<?= $row['author'] ?>" required><br>

        <label for="biography">Biografi:</label>
        <textarea name="biography"><?= $row['biography'] ?></textarea><br>

        <input type="submit" value="Update Buku">
    </form>
</body>
</html>
