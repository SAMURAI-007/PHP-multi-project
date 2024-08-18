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
    $username = $_POST['user'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];

    $res = $conn->prepare("INSERT INTO `user`(`username`, `email`, `phone`, `password`) VALUES (?,?,?,?)");
    $res->bindValue(1, $username);
    $res->bindValue(2, $email);
    $res->bindValue(3, $number);
    $res->bindValue(4, $password);
    $res->execute();
    header('location:../index.php');
}
