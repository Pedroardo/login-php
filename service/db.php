<?php 
$hostname = "localhost";
$username= "root";
$password= "";
$database_name= "belajar_login-php";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error){
    echo "Koneski API Error";
    die("Connection failed: " . $db->connect_error);
}

echo "Koneksi Berhasil";

?>