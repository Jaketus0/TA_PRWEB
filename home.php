<?php
    include 'conf/connection.php';
    session_start();
    if(!isset($_SESSION['email'])) {
        echo "<script>
            alert('You must login first!!');
            window.location.href='index.php';
            </script>";
    }
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
        <div class="logo">
            <img src="asset/img/AVH.png" alt="Logo" onclick="window.location.href='home.php'">
            <div class="hamburger">
                <span class="bar"></span>    
                <span class="bar"></span>    
                <span class="bar"></span>    
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>    
                <li class="nav-item"><a href="ticket.php" class="nav-link">Ticket</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <?php
                    if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com') {
                        echo '<li><a href="inputdata.php">Input</a></li>';
                    }
                    ?> 
                <li class="nav-item"> 
                    <form action="search.php" method="post">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <button type="submit" id="searchb"><i class="fas fa-magnifying-glass"></i></button>
                    </form>
                </li>
                <li class="nav-item"><a href="conf/logout.php" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </div>
    <div id="daftar_konser">
        <h1>Daftar Konser</h1>
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
<script src="https://kit.fontawesome.com/ef9e5793a4.js" crossorigin="anonymous"></script>
<script src="asset/js/script.js"></script>
</html>