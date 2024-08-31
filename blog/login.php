<?php
if (isset($_POST['sub'])) {
  require('../config/database.php');

  $uname = $_POST['username'];
  $pass = $_POST['password'];

  $res = $conn->prepare("SELECT * FROM `user` WHERE (Username = :key OR email = :key OR phone = :key) AND (password = :password)");
  $res->bindValue(":key", $uname);
  $res->bindValue(":password", $pass);
  $res->execute();
  if ($res->rowCount() > 0) {
    $data = $res->fetch(PDO::FETCH_ASSOC);
    var_dump($data);
    $_SESSION["login"] = true;
    $_SESSION["role"] = $data['role'];
    $_SESSION["name"] = $data['Username'];
    $_SESSION["id"] = $data["id"];
    header("location:./index.php");
  }else {
    echo "<script>alert('Username or password incorrect!');</script>";
  }

}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <title>Login</title>
</head>

<body>
  <div class="login-container">
    <form class="login-form" method="post">
      <h1>Welcome Back</h1>
      <p>Please login to your account</p>
      <div class="input-group">
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" name="sub">Login</button>
    </form>
  </div>
</body>

</html>