<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];

    if ($password == $confirm_password) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, dob, gender, role) VALUES ('$username', '$password_hashed', '$dob', '$gender', 'customer')";
        
        if (mysqli_query($conn, $sql)) {
            echo "Registrasi berhasil!";
            header('Location: login.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Konfirmasi password tidak sesuai!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Registrasi</h2>
        <form action="register.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Ulangi Password:</label>
            <input type="password" name="confirm_password" required>

            <label>Tanggal Lahir:</label>
            <input type="date" name="dob" required>

            <label>Jenis Kelamin:</label>
            <select name="sex" required>
                <option value="male">Pria</option>
                <option value="Female">Wanita</option>
                <option value="other">lainnya</option>
            </select>
            <button type="submit">Register</button>
            <p>Sudah memiliki akun? <a href="login.html">Login Sekarang</a></p>
        </form>
    </div>
</body>
</html>
