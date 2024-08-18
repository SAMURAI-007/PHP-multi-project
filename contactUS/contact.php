<?php
require("../config/database.php");
if (isset($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $msg = $_POST['msg'];

    $res = $conn->prepare("INSERT INTO `contacts` (`name`, `email` , `mobile`, `message`) VALUES (?,?,?,?)");
    $res->bindValue(1,$name);
    $res->bindValue(2,$email);
    $res->bindValue(3,$mobile);
    $res->bindValue(4,$msg);
    $res->execute();
    if ($res) {
        header("location:./index.php?success=ok");
    }

}