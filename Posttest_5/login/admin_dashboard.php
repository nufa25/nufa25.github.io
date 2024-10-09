<?php
include 'config.php';

// Menangani penyimpanan data buku
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
    $target = "book/" . basename($image);
    

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO buku (isbn, title, synopsis, image, language, genre, pages_count, book_type, publish_date, author, biography)
                VALUES ('$isbn', '$title', '$synopsis', '$image', '$language', '$genre', '$page_count', '$book_type', '$publish_date', '$author', '$biography')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Buku berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}

$result = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Buku</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Tambah Buku</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" required><br>

        <label for="title">Judul:</label>
        <input type="text" name="title" required><br>

        <label for="synopsis">Sinopsis:</label>
        <textarea name="synopsis"></textarea><br>

        <label for="image">Gambar:</label>
        <input type="file" name="image" required><br>

        <label for="language">Bahasa:</label>
        <input type="text" name="language" required><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" required><br>

        <label for="page_count">Jumlah Halaman:</label>
        <input type="number" name="page_count" required><br>

        <label for="book_type">Jenis Buku:</label>
        <input type="text" name="book_type" required><br>

        <label for="publish_date">Tanggal Terbit:</label>
        <input type="date" name="publish_date" required><br>

        <label for="author">Penulis:</label>
        <input type="text" name="author" required><br>

        <label for="biography">Biografi:</label>
        <textarea name="biography"></textarea><br>

        <input type="submit" value="Simpan Buku">
    </form>

    <h2>Daftar Buku</h2>
    <table border="1">
        <tr>
            <th>ISBN</th>
            <th>Judul</th>
            <th>Sinopsis</th>
            <th>Gambar</th>
            <th>Bahasa</th>
            <th>Genre</th>
            <th>Jumlah Halaman</th>
            <th>Jenis Buku</th>
            <th>Tanggal Terbit</th>
            <th>Penulis</th>
            <th>Biografi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['isbn'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['synopsis'] ?></td>
                <td><img src="book/<?= $row['image'] ?>" width="100"></td>
                <td><?= $row['language'] ?></td>
                <td><?= $row['genre'] ?></td>
                <td><?= $row['pages_count'] ?></td>
                <td><?= $row['book_type'] ?></td>
                <td><?= $row['publish_date'] ?></td>
                <td><?= $row['author'] ?></td>
                <td><?= $row['biography'] ?></td>
                <td>
                    <a href="admin_edit.php?isbn=<?= $row['isbn'] ?>">Edit</a>
                    <a href="admin_delete.php?isbn=<?= $row['isbn'] ?>">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
