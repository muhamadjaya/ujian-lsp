<?php
require '../functions.php';
$datapendaftaran = query("SELECT * FROM tb_pendaftaran_kursus");
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
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="data_kursus.php">Data Kursus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_mahasiswa.php">Data Mahasiswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_jadwal.php">Data Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="pendaftaran_peserta.php">Pendaftaran Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="laporan.php">Laporan</a>
            </li>
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
                <h3>Data Pendaftaran Peserta Kursus</h3>
                <p>
                Silakan verivikasi data pendaftar
                </p>
                <table class="table table-bordered table-hover table-responsive-md" id="example" style="margin-bottom: 2rem;">
                <thead class="thead-dark text-center">
                    <tr> 
                        <th scope="col">No.</th>
                        <th scope="col">ID Pendaftaran</th>
                        <th scope="col">ID Mahasiswa</th>
                        <th scope="col">ID Kursus</th>
                        <th scope="col">KRS</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach( $datapendaftaran as $row ) : ?>
                    <tr>
                        <td class="text-center" scope="row">
                            <?= $i; ?>
                        </td>
                        <td>
                            <?= $row["id_pendaftaran_kursus"]; ?>
                        </td>
                        <td>
                            <?= $row["id_mahasiswa"]; ?>
                        </td>
                        <td>
                            <?= $row["id_kursus"]; ?> 
                        </td>
                        <td>
                            <?= $row["krs"]; ?> 
                        </td>
                        <td>
                            <?php
                                if ($row["verifikasi"] == 0 ) {
                                    echo "<p> Belum Terverifikasi </p>";
                                } else {
                                    echo "<p> Terverifikasi </p>";
                                }
                            ?>
                      
                        </td>
                        <td>
                        <?php
                                if ($row["verifikasi"] == 0 ) {
                                    $id_pendaftaran=$row["id_pendaftaran_kursus"];                                    
                                    echo "<a href='./verify.php?id_pendaftaran_kursus=$row[id_pendaftaran_kursus]' class='badge text-bg-warning'>terima</a>";
                                } else {
                                    echo "<span class='badge text-bg-success'>diterima</span>";
                                }
                            ?>                            
                           
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
           
       </div> 
    <!-- end of content -->


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>