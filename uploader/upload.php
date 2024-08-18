<?php
require("../config/database.php");

$target_dir = "uploads/";
$saved_name = time() . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $saved_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header("location:./index.php?back=ok");
        $res = $conn->prepare("INSERT INTO `files` (`name`, `time`) VALUES (?,?)");
        $res->bindValue(1, $saved_name);
        $res->bindValue(2, time());
        $res->execute();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
