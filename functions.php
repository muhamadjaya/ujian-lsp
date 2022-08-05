<?php
// koneksi ke database
$conn = mysqli_connect("localhost","root","","db_kursus");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    // ambil data
    $nama_wisata = strip_tags($data["nama_wisata"]);
    $deskripsi = $data["deskripsi"];
    $deskripsi2 = $data["deskripsi2"];
    $kategori = strip_tags($data["kategori"]);
    $alamat = strip_tags($data["alamat"]);
    $latitude = strip_tags($data["latitude"]);
    $longitude = strip_tags($data["longitude"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    } 

    $keterangan_gambar = strip_tags($data["keterangan_gambar"]);

    $video = $data["video"];
    $keterangan_video = strip_tags($data["keterangan_video"]);

    $keterangan = $data["keterangan"];

    $id_user=strip_tags($data["id_user"]);

     // query insert data
     $query = "INSERT INTO tb_wisata
                VALUES
            (0, '$nama_wisata', '$deskripsi', '$deskripsi2', '$kategori', '$alamat', '$latitude', '$longitude', '$gambar', '$keterangan_gambar', '$video', '$keterangan_video', '$keterangan', '$id_user')
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}


function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
            echo "<script> 
                    alert('Pilih gambar terlebih dahulu!');
                  </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script> 
                    alert('Yang anda upload bukan gambar!');
                  </script>";
            return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script> 
                    alert('Ukuran gambar terlalu besar!');
                  </script>";
            return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/wisata/' . $namaFileBaru);

    return $namaFileBaru;
}

function tambahpendaftaran($data) {
    global $conn;
    // ambil data
    $id_mahasiswa = $data["id_mahasiswa"];
    $id_kursus = $data["id_kursus"];

    // upload pdf
    $pdf = uploadpdf();
    if( !$pdf ) {
        return false;
    } 

     // query insert data
     $query = "INSERT INTO tb_pendaftaran_kursus
                VALUES
            (0, '$id_mahasiswa', '$id_kursus', '$pdf', 0)
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}

function uploadpdf() {
    $namaFile = $_FILES['pdf']['name'];
    $ukuranFile = $_FILES['pdf']['size'];
    $error = $_FILES['pdf']['error'];
    $tmpName = $_FILES['pdf']['tmp_name'];

    // cek apakah tidak ada pdf yang diupload
    if ( $error === 4 ) {
            echo "<script> 
                    alert('Pilih pdf terlebih dahulu!');
                  </script>";
            return false;
    }

    // cek apakah yang diupload adalah pdf
    $ekstensiPdfValid = ['pdf'];
    $ekstensiPdf = explode('.', $namaFile);
    $ekstensiPdf = strtolower(end($ekstensiPdf));
    if( !in_array($ekstensiPdf, $ekstensiPdfValid) ) {
        echo "<script> 
                    alert('Yang anda upload bukan Pdf!');
                  </script>";
            return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 2000000 ) {
        echo "<script> 
                    alert('Ukuran pdf terlalu besar!');
                  </script>";
            return false;
    }

    // lolos pengecekan, pdf siap diupload
    // generate nama pdf baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiPdf;
    move_uploaded_file($tmpName, './assets/pdf/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_wisata WHERE id_wisata = '$id'");

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    // ambil data
    $id = $data["id_wisata"];
    $nama_wisata = htmlspecialchars($data["nama_wisata"]);
    $deskripsi = $data["deskripsi"];
    $deskripsi2 = $data["deskripsi2"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $latitude = htmlspecialchars($data["latitude"]);
    $longitude = htmlspecialchars($data["longitude"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $keterangan_gambar = htmlspecialchars($data["keterangan_gambar"]);

    $video = $data["video"];
    $keterangan_video = htmlspecialchars($data["keterangan_video"]);

    $keterangan = $data["keterangan"];

    $id_user = htmlspecialchars($data["id_user"]);

     // query insert data
     $query = "UPDATE tb_wisata SET
                nama_wisata = '$nama_wisata', 
                deskripsi = '$deskripsi',   
                deskripsi2 = '$deskripsi2',    
                kategori = '$kategori',
                alamat = '$alamat',
                latitude = '$latitude',
                longitude = '$longitude',
                gambar = '$gambar',
                keterangan_gambar = '$keterangan_gambar',
                video = '$video',
                keterangan_video = '$keterangan_video',
                keterangan = '$keterangan',
                id_user = '$id_user'
                WHERE id_wisata = '$id'
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}


function cari($keyword) {
    $query = "SELECT * FROM tb_wisata
                WHERE 
                nama_wisata LIKE '%$keyword%'
            ";

    return query($query);            
}


function carialam($keyword) {
    $query = "SELECT * FROM tb_wisata
                WHERE kategori='alam' AND
                nama_wisata LIKE '%$keyword%'
            ";

    return query($query);            
}


function caripantai($keyword) {
    $query = "SELECT * FROM tb_wisata
                WHERE kategori='pantai' AND
                nama_wisata LIKE '%$keyword%'
            ";

    return query($query);            
}


function carireligi($keyword) {
    $query = "SELECT * FROM tb_wisata
                WHERE kategori='religi' AND
                nama_wisata LIKE '%$keyword%'
            ";

    return query($query);            
}


function cariberita($keyword) {
    $query = "SELECT * FROM tb_berita
                WHERE 
                judul LIKE '%$keyword%'
            ";

    return query($query);            
}


function cariadmin($keyword) {
    $query = "SELECT * FROM tb_user
                WHERE 
                nama LIKE '%$keyword%'
            ";

    return query($query);            
}


function registrasi($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
    if( mysqli_fetch_assoc($result) ) {
        echo "<script> 
                alert('username sudah terdaftar!');
             </script>";
        return false;
    }

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script> 
                alert('konfirmasi password tidak sesuai!');        
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // generate id admin
    // $recordset = mysqli_query($conn, "SELECT MAX(id_user) as recordCount FROM tb_user");
    // $recordcount = mysqli_fetch_assoc($recordset);
    // $idadminauto = $recordcount['recordCount'];

    // $urutan = (int) substr($idadminauto, 3, 3);

    // $urutan++;

    // $huruf = "ADM";
    // $idadminauto = $huruf . sprintf("%02s", $urutan);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO tb_user VALUES(0, '$nama', '$username', '$password', '$telepon')");

    return mysqli_affected_rows($conn);
}


function tambahberita($data) {
    global $conn;
    // ambil data
    $judul = strip_tags($data["judul"]);
    $isi = $data["isi"];
    $tgl_posting = $data["tgl_posting"];

    $tanggal = substr($tgl_posting,0,2);
    $bulan   = substr($tgl_posting,3,2);
    $tahun   = substr($tgl_posting,6,4);

    // $tanggal = substr($tgl_posting,8,2);
    // $bulan   = getBulan(substr($tgl_posting,5,2));
    // $tahun   = substr($tgl_posting,0,4);

    $tglan = date($tahun.'-'.$bulan.'-'.$tanggal);
    // $tglan = date("Y-m-d");

    $sumber = strip_tags($data["sumber"]);

    // upload gambar
    $gambar = uploadberita();
    if( !$gambar ) {
        return false;
    }

    $keterangan_gambar = strip_tags($data["keterangan_gambar"]);

    $id_user=strip_tags($data["id_user"]);

     // query insert data
     $query = "INSERT INTO tb_berita
                VALUES
            (0, '$judul', '$isi', '$tglan', '$sumber', '$gambar', '$keterangan_gambar', '$id_user')
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}

function uploadberita() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
            echo "<script> 
                    alert('Pilih gambar terlebih dahulu!');
                  </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script> 
                    alert('Yang anda upload bukan gambar!');
                  </script>";
            return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script> 
                    alert('Ukuran gambar terlalu besar!');
                  </script>";
            return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
     $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/berita/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapusberita($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_berita WHERE id_berita = '$id'");

    return mysqli_affected_rows($conn);
}


function ubahberita($data) {
    global $conn;
    // ambil data
    $id = $data["id_berita"];
    $judul = strip_tags($data["judul"]);
    $isi = strip_tags($data["isi"]);
    $tgl_posting = strip_tags($data["tgl_posting"]);
    $gambarLama = strip_tags($data["gambarLama"]);

    $tanggal = substr($tgl_posting,0,2);
    $bulan   = substr($tgl_posting,3,2);
    $tahun   = substr($tgl_posting,6,4);

    $tglan = date($tahun.'-'.$bulan.'-'.$tanggal);

    $sumber = strip_tags($data["sumber"]);

    $id_user=strip_tags($data["id_user"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadberita();
    }

     $keterangan_gambar = strip_tags($data["keterangan_gambar"]);

     // query insert data
     $query = "UPDATE tb_berita SET
                judul = '$judul', 
                isi = '$isi',      
                tgl_posting = '$tglan',
                sumber = '$sumber', 
                gambar = '$gambar',
                keterangan_gambar = '$keterangan_gambar', 
                id_user = '$id_user'
                WHERE id_berita = '$id'
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}


function hapusadmin($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = '$id'");

    return mysqli_affected_rows($conn);
}


function ubahadmin($data) {
    global $conn;
    // ambil data
    $id = $data["id_user"];
    $nama = strip_tags($data["nama"]);
    $username = strip_tags($data["username"]);
    $oldpassword = strip_tags($data["oldpassword"]);
    $passwordlama = strip_tags($data["passwordlama"]);
    $password = strip_tags($data["password"]);
    $password2 = strip_tags($data["password2"]);
    $telepon = strip_tags($data["telepon"]);

    // $passwordlama = password_hash($passwordlama, PASSWORD_DEFAULT);
    $oldpassword = password_verify($passwordlama, $oldpassword);

    // cek password lama
    if( $oldpassword !== true ) {
        echo "<script> 
                alert('password lama tidak sesuai!');        
              </script>";
        return false;
    }


    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script> 
                alert('konfirmasi password tidak sesuai!');        
              </script>";
        return false;
    }

    
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

     // query insert data
     $query = "UPDATE tb_user SET
                nama = '$nama', 
                username = '$username',      
                password = '$password',
                telepon = '$telepon'
                WHERE id_user = '$id'
            ";
     
     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
}
?>