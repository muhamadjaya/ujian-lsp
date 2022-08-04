<?php
session_start();
require 'functions.php';

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE username = '$username'");
    if( mysqli_num_rows($result) === 1 ) {
        echo "<script> alert('Login Sukses') </script>";
        $row = mysqli_fetch_assoc($result);
            if($password === $row["password"])  {
            	$_SESSION["login"] = true;
                $_SESSION["id_mahasiswa"] = $row["id_mahasiswa"];
                echo "<script> alert('Login Sukses') </script>";
                header("Location: user/index.php");
                exit;
            	}              
    } 
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Course Lembaga Kursus Universitas Jewepe</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>
<body>    

    <!-- content -->
       <div class="row mx-4 mt-4 justify-content-between">
          <div class="col">
          <form action="" method="post">
            <div class="form-group">
            <h2>Selamat Datang!</h1><br>
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
            </div>
            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required autocomplete="off">
            </div>

            <div class="form-group">
            <?php if( isset($error) ) : ?>
                <p style="color: red; font-style: italic">username / password salah</p>
            <?php endif; ?>
            </div>

            <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">Login</button>
            
            </form>
          </div>           
       </div> 
    <!-- end of content -->


    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>