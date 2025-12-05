<?php 
include("service/db.php");
session_start();

$register_message = "";

if(isset($_SESSION["is_login"])){
    header("location: dashboard.php");
}

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    try {
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
    IF($db->query($sql)){
        $register_message = "Registrasi Berhasil, Silakhkan Login";
    }else {
        $register_message ="Registrasi Gagal";
    }
    } catch (mysqli_sql_exception $e) {
        $register_message = $e->getMessage();
    }
    $db->close();
}

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  include "layout/header.html" ?>
    <h2>Daftar Akun</h2>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    <p><?=$register_message?></p>
</body>
</html>