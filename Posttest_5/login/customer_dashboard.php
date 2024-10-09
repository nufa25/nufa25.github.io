<?php
session_start();
if (!isset($_SESSION['customer'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['customer']; ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
