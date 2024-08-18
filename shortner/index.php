<?php $page_type = "create"; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Link shortner</title>
    <link rel="stylesheet" href="../login/assets/css/style.css">
</head>

<body>

    <div class="row col-sm" style="margin-top: 100px;">
        <form id="shorten-form" method="post" action="./shorten.php">
            <h2>Paste Your link here</h2>
            <input type="url" name="main-link" class="form-control" id="shorten-input" placeholder="Insert your link" required>
            <input type="url" name="custom-link" class="form-control" id="shorten-input" value="http://localhost/link?url=" required>
            <button type="submit" id="shorten-button" class="btn btn-primary btn-sm" style="margin-top: 5px;" onclick="shortenLink()">Submit</button>
            <?php
            if (isset($_GET['submited'])) {
                
                if ($_GET['submited'] != "false") {
                  ?> <script>alert("success ! you link is : <?php echo $_GET['submited']; ?> ");</script> <?php
                } elseif ($_GET['submited'] == "false") {
                    echo '<script>alert("Link already Exists !");</script>';
                }
            }
            ?>
        </form>
    </div>


</body>

<script src="../login/assets/script/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>