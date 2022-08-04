<?php

require '../functions.php';

$id_pendaftaran_kursus = $_GET["id_pendaftaran_kursus"];

$query = mysqli_query($conn, "UPDATE tb_pendaftaran_kursus SET id_mahasiswa=id_mahasiswa, id_kursus=id_kursus, krs=krs, verifikasi='1' WHERE id_pendaftaran_kursus = '$id_pendaftaran_kursus'");

if ($query) {
    echo "<script>alert('Berhasil!'); document.location.href = './pendaftaran_peserta.php';</script>";
} else {
    echo "<script>alert('Gagal!'); document.location.href = './pendaftaran_peserta.php';</script>";
}

?>