<?php
require("../config/database.php");

$res = $conn->prepare("SELECT * FROM `contacts`");
$res->execute();
$datas = $res->fetchAll(PDO::FETCH_ASSOC);
$showList = true;

if (isset($_GET['id'])) {
    $showList = false;
    $res = $conn->prepare("SELECT * FROM `contacts` WHERE id=?");
    $res->bindValue(1, $_GET['id']);
    $res->execute();
    $data = $res->fetch(PDO::FETCH_ASSOC);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Contact us</title>
</head>

<body>


    <?php if ($showList) { ?>
        <div class="container" style="margin-top: 100px;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Email</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $key => $data) { ?>
                        <tr>
                            <th scope="row"><?= ++$key ?></th>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td>
                                <a href="?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm">Show message</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="./index.php" class="btn btn-info">Back to main page</a>
        </div>
    <?php }else{ ?>
        <div class="container" style="margin-top:100px;">
            <h2>User message</h2>
            <br>
            <p><?php echo $data['message'] ; ?></p>
            <a href="./admin.php" class="btn btn-secondary">Back</a>
        </div>
    <?php } ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</html>