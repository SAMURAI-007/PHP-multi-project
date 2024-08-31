<?php
require("../../config/database.php");

$pid = $_GET['id'];

$wri = $conn->prepare("SELECT * FROM `post` WHERE `id` = $pid");
$wri->execute();
$wdata = $wri->fetch(PDO::FETCH_ASSOC);
$str = $wdata['image'];

if (isset($_POST["sub"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $target_dir = "./images/";
    $saved_name = time() . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $saved_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo '<script>alert("there was an error uploading your file");</script>';
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $path = "http://localhost/PHP-multi-project/blog/admin/images/" . $saved_name;
        } else {
            echo '<script>alert("there was an error uploading your file");</script>';
        }
    }

    $res = $conn->prepare("UPDATE `post` SET `title`=?,`content`=?,`image`=? WHERE `id`=$pid");
    $res->bindValue(1, $title);
    $res->bindValue(2, $content);
    $res->bindValue(3, $path);
    $res->execute();
    if ($res) {
        header("location:./");
    }

}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../css/tiny-slider.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/glightbox.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/flatpickr.min.css">

    <link rel="stylesheet" href="./assets/ckeditor5.css">


    <title>Blogy &mdash; Free Bootstrap 5 Website Template by Untree.co</title>
</head>
<style>
    .main-container {
        width: 795px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <a href="index.html" class="logo m-0 float-start">Blogy<span
                                    class="text-primary">.</span></a>
                        </div>
                        <div class="col-8 text-center">
                            <form action="#" class="search-form d-inline-block d-lg-none">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bi-search"></span>
                            </form>

                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                <li><a href="./">Back to dashboard</a></li>
                            </ul>
                        </div>
                        <div class="col-2 text-end">
                            <a href="#"
                                class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Edit your post</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <form action="#">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <input name="title" type="text" class="form-control" placeholder="Post Title"
                                        value="<?php echo $wdata['title']; ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control"
                                        placeholder="File">
                                </div>
                                <div class="col-12 mb-3">
                                    <a class="form-control" href="<?php echo "./images" . substr($str, 52); ?>">See
                                        current image</a>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="content" id="editor" cols="30" rows="7" class="form-control"
                                        placeholder="Message"><?php echo $wdata['content']; ?></textarea>
                                </div>

                                <div class="col-12">
                                    <input type="submit" name="sub" value="Submit Post" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- /.untree_co-section -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="./assets/ckeditor5.js"></script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from './assets/ckeditor5.js';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            })
            .then( /* ... */)
            .catch( /* ... */);
    </script>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/tiny-slider.js"></script>

    <script src="../js/flatpickr.min.js"></script>


    <script src="../js/aos.js"></script>
    <script src="../js/glightbox.min.js"></script>
    <script src="../js/navbar.js"></script>
    <script src="../js/counter.js"></script>
    <script src="../js/custom.js"></script>


</body>


</html>