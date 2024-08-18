<?php
require("../config/database.php");
if (isset($_GET['back'])) {
    echo '<script>alert("file successfuly uploaded !");</script>';
}

$res = $conn->prepare("SELECT * FROM `files`");
$res->execute();
$datas = $res->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['id'])) {
    $res = $conn->prepare('DELETE FROM `files` WHERE id = ?');
    $res->bindValue(1,$_GET['id']);
    $res->execute();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>File Uploader</title>
</head>

<body>

    <div class="container col-lg col-4" style="margin-top: 100px;">
        <form class="form-control" action="upload.php" method="post" enctype="multipart/form-data">
            Select file to upload:
            <input type="file" id="formFile" class="custom-file-upload" name="fileToUpload" id="fileToUpload">
            <input class="btn btn-success" type="submit" value="Upload file" name="submit">
        </form>
        <div class="container" style="margin-top: 100px;">
            <table class="table table-striped" style="max-width: 500px;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $key => $data) { ?>
                        <tr>
                            <th scope="row"><?= ++$key ?></th>
                            <td><?= $data['name'] ?></td>
                            <td>
                                <a href="uploads/<?php echo $data['name']; ?>" class="btn btn-primary btn-sm">Download Link</a><a class="btn btn-danger btn-sm" style="margin-left: 5px;" href="?id=<?php echo $data['id'] ?>">Delete File</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>