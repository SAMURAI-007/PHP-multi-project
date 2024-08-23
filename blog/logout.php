<?php 
require_once("../config/database.php");
$_SESSION['login'] = false;
$_SESSION['name'] = null;
$_SESSION['role'] = null;
header("location:./");