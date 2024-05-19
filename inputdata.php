<?php
    include 'conf/connection.php';
    // session_start();
    // if(!isset($_SESSION['email'])) {
    //     echo "<script>
    //         alert('You must login first!!');
    //         window.location.href='index.php';
    //         </script>";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVH Tickets</title>
    <link rel="stylesheet" href="asset/style/style.css">
</head>
<body>
    <div id="navbar">
        <div class="container">
            <div class="logo">
                <ul>
                    <li><img src="asset/img/AVH.png" alt="Logo"></li>
                    <li><a href="home.php">Home</a></li>    
                    <li><a href="ticket.php">Ticket</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="conf/logout.php">Logout</a></li>
                    <li><input type="text" id="search"></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="inputdata">
        <div class="form_input">
            <form action="conf/insert.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label for="nama_konser">Nama Konser</label></td>
                        <td>: <input type="text" name="nama_konser" id="nama_konser" required></td>
                    </tr>
                    <tr>
                        <td><label for="lokasi">Lokasi</label></td>
                        <td>: <input type="text" name="lokasi" id="lokasi" required></td>
                    </tr>
                    <tr>
                        <td><label for="kota">Kota</label></td>
                        <td>: <input type="text" name="kota" id="kota" required></td>
                    </tr>
                    <tr>
                        <td><label for="harga">Harga</label></td>
                        <td>: <input type="text" name="harga" id="harga" required></td>
                    </tr>
                    <tr>
                        <td><label for="tgl">Tanggal</label></td>
                        <td>: <input type="date" name="tgl" id="tgl" required></td>
                    </tr>
                    <tr>
                        <td><label for="gambar">Gambar</label></td>
                        <td>: <input type="file" name="gambar" id="gambar" required></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="input" value="input">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
</body>
<script src="asset/js/script.js"></script>
</html>