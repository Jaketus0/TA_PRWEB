<?php
    include 'connection.php';
    if(isset($_POST['input'])) {
        $nama_konser = $_POST['nama_konser'];
        $lokasi = $_POST['lokasi'];
        $kota = $_POST['kota'];
        $harga = $_POST['harga'];
        $tgl = $_POST['tgl'];
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $path = "../asset/tmp/cover/".$gambar;
        move_uploaded_file($tmp, $path);
        $sql = "INSERT INTO daftarkonser (nama_konser, tgl_konser, lokasi, kota, harga, gambar) VALUES ('$nama_konser', '$tgl', '$lokasi', '$kota', '$harga', '$gambar')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href='../inputdata.php';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan');
                window.location.href='../inputdata.php';
                </script>";
        }
    }
?>