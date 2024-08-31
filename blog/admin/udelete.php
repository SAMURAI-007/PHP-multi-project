<?php
require("../../config/database.php");
$uid = $_GET['id'];

$res = $conn->prepare("DELETE FROM `user` WHERE `id` = $uid");
$res->execute();
if ($res) {
    header("location:./");
}
