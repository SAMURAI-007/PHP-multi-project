<?php 

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=PHP-PROJECTS", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST)) {
    $udata = $_POST['udata'];
    $password = $_POST['pass'];

    $res = $conn->prepare("SELECT * FROM `user` WHERE (username = :key OR email = :key OR phone = :key) AND (password = :password)");
    $res->bindValue(":key",$udata);
    $res->bindValue(":password",$password);
    $res->execute();

    $data = $res->rowCount();

    if ($data) {
        echo "success";
    }else {
        header('location:../index.php?notfound=ok');
    }   
}