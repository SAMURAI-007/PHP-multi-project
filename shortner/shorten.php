<?php
require("../config/database.php");

if (isset($_POST)) {
    $mlink = $_POST['main-link'];
    $clink = $_POST['custom-link'];
    echo $clink . $mlink;

    $res = $conn->prepare("SELECT * FROM `link` WHERE `custom-link`=? ");
    $res->bindValue(1, $clink);
    $res->execute();
    if (!$res->rowCount()) {
        $sub = $conn->prepare("INSERT INTO `link`(`main-link`, `custom-link`) VALUES (:c,:e)");
        $sub->bindValue(":c", $mlink);
        $sub->bindValue(":e", $clink);
        $sub->execute();
        header("location:./index.php?submited=$clink");
    }else {
        header("location:./index.php?submited=false");
    }
}
