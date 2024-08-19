<?php
$id = $_GET['trackId'];
$status = $_GET['status'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Payment verification</title>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-3 fw-bolder">IPG verification page</h1>
                <p class="lead fw-normal text-white-50 mb-0">This page is only for you demo payment results</p>
            </div>
        </div>
    </header>
    <br><br>
    <div class="row col-mb-5">
        <?php
        if (isset($_GET['success'])) {
            $result = null;
            switch ($status) {
                case 1:
                    echo "<p style='text-align:center;' class='alert alert-success display-5 fw-bolder'>Your payment was successfull !</p>";
                    break;
                case 2:
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://gateway.zibal.ir/v1/verify',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
  "merchant": "zibal",
  "trackId" : "3718838088"
}',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'
                        ),
                    ));

                    $response = curl_exec($curl);
                    $result = (array) json_decode($response);

                    curl_close($curl);
                    if ($result['message'] == 'previously verifed') {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://gateway.zibal.ir/v1/inquiry',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
  "merchant": "zibal",
  "trackId" : "3718838088"
}',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        $result = (array) json_decode($response);
                        $date = $result['paidAt'];
                        echo "<p style='text-align:center;' class='alert alert-success display-5 fw-bolder'>Your payment was successfull !</p>";
                        echo "</br>";
                        echo "<p style='text-align:center;' class='alert alert-primary display-5 fw-bolder'>You paid at : " . $date . "</p>";
                    }

                    break;
                case 3:
                    echo "<p style='text-align:center;' class='alert alert-danger display-5 fw-bolder'>There was a problem in your payment !</p>";
                    break;
            }
        }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>