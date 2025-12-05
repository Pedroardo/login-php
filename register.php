<?php 
include("service/db.php");
session_start();

$register_message = "";

if(isset($_SESSION["is_login"])){
    header("location: dashboard.php");
    exit;
}

if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi form kosong
    if(empty($username) || empty($password)){
        $register_message = "Username dan Password wajib diisi!";
    } 
    elseif(strlen($password) < 6){
        $register_message = "Password minimal 6 karakter!";
    } else {
        // Validasi unik username
        $sql_check = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($sql_check);

        if($result->num_rows > 0){
            $register_message = "Username sudah terdaftar!";
        } else {
            // Lolos semua validasi → simpan ke database
            $hash_password = hash("sha256", $password);
            $sql_insert = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
            
            if($db->query($sql_insert)){
                $register_message = "Registrasi Berhasil, Silakan Login.";
            } else {
                $register_message = "Registrasi gagal.";
            }
        }
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
        <input type="text" placeholder="username" name="username" require>
        <input type="password" placeholder="password" name="password" require>
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    <p><?=$register_message?></p>
</body>
</html>