<?php
if (isset($_POST['btnSubmit'])) {
    require('../config/database.php');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $msg = $_POST['msg'];

    // validation semi middleware here
    $errormsg = [];
    if ($name = "" || $name < 3) {
        array_push($errormsg, ["message" => "name should be at least 3 chars"]);
    }
    if ($msg = "" || $msg < 25) {
        array_push($errormsg, ["message" => "message should be at least 25 chars"]);
    }

    if (count($errormsg) < 1) {
        $res = $conn->prepare("INSERT INTO `contacts` (`name`, `email` , `mobile`, `message`) VALUES (?,?,?,?)");
        $res->bindValue(1, $name);
        $res->bindValue(2, $email);
        $res->bindValue(3, $mobile);
        $res->bindValue(4, $msg);
        $res->execute();
        if ($res) {
            echo '<script>alert("Message successfuly sent!");</script>';
        }
    } else if ($errormsg) {
        echo '<script>alert("Message not sent!");</script>';
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Contact us</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
        </div>
        <form method="post">
            <h3>Drop Us a Message</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name"  />
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Your Email" />
                    </div>
                    <div class="form-group">
                        <input type="number" name="mobile" class="form-control" placeholder="Your Phone Number" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        <a href="./admin.php" class="btn btn-primary">admin panel</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="msg" class="form-control" placeholder="Your Message" style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <br>
                    <?php
                    if (isset($errormsg)) {
                    ?>
                        <span>
                            <?php
                            foreach ($errormsg as $data) {
                                echo "<ul>";
                                echo "<li>";
                                echo $data['message'] ;
                                echo "</li>";
                                echo "</ul>";
                            }
                            ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>

    </div>

</body>

<script src="../login/assets/script/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>