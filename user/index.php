<?php
require '../functions.php';
$datakursus = query("SELECT * FROM tb_kursus");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Course Lembaga Kursus Universitas Jewepe</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3 px-3 shadow-sm" style="background-color: #FFFFFF;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="../assets/img/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            E-Course Lembaga Kursus Universitas Jewepe
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li> -->
            <!-- <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
            </li> -->
        </ul>
        <span class="navbar-text">
            <a class="nav-link text-primary" href="logout.php">(Log Out)</a>
        </span>
        </div>
    </div>
    </nav>
    <!-- end of navbar -->

    <!-- title Head -->
    <div class="row title-head ms-4 mt-4">
        <div class="col-12">
            <h1>E-Course Berbasis Virtual Universitas Jewepe</h1>
        </div>
    </div>
    <!-- end of title head -->

    <!-- content -->
       <div class="row mx-4 mt-4 justify-content-between">
            <div class="col-7">
                <h3>Selamat Datang</h3>
                <p>
                Silakan pilih kursus
                </p>
                <form action="" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group row justify-content-start">
                    <label for="nama_mahasiswa" class="col-sm-3 col-form-label">Nama Mahasiswa</label> 
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_mahasiswa" id="nama_mahasiswa" required autocomplete="off">
                    </div>
                </div> -->

                <div class="form-group row justify-content-start">
                    <label for="kursus" class="col-sm-3 col-form-label">Kursus</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="kursus" id="kursus">
                        <?php foreach( $datakursus as $row ) : ?>
                        <option value="<?= $row["id_kursus"]; ?><"><?= $row["nama_kursus"]; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>                
               

                <div class="form-group row justify-content-start">
                    <label for="krs" class="col-sm-3 col-form-label">Upload KRS</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control-file" name="krs" id="krs" required autocomplete="off">
                    </div>
                </div>

                <div class="form-group row justify-content-start">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-8">
                        <button type="submit" name="submit" class="btn btn-primary" style="width: 25%;">Simpan</button>
                        <a href="kelola_wisata.php" class="btn btn-danger" style="width: 25%;">Batal</a>
                    </div>
                </div>
                </form>
            </div>
           
       </div> 
    <!-- end of content -->


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>