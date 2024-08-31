<?php
require("../../config/database.php");
$pid = $_GET['id'];

$res = $conn->prepare("DELETE FROM `post` WHERE `id` = $pid");
$res->execute();
if ($res) {
    header("location:./");
}
