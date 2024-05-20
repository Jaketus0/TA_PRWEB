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
    <div id="daftar_konser">
        <ul>
            <?php
            $query = "SELECT * FROM daftarkonser";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $concert_id = $row['id_konser'];
                // Convert date to desired format
                $date = strtotime($row['tgl_konser']);
                $formatted_date = date('d F Y', $date); // dd F yyyy format

                echo "<li data-concert-id='$concert_id'>
                  <img src='asset/tmp/cover/" . $row['gambar'] . "' alt='" . $row['nama_konser'] . "'>
                  <div class='details'>
                    <h3>" . $row['nama_konser'] . "</h3>
                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>" . $formatted_date . "</td> 
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>" . $row['lokasi'] . "</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>" . $row['kota'] . "</td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Rp." . $row['harga'] . "</td>
                        </tr>
                    </table>
                  </div>
                </li>";
              }
            }

            ?>
        </ul>
    </div>
</body>
<script src="asset/js/script.js"></script>
</html>