<?php
    include 'conf/connection.php';
    session_start();
    $isLoggedIn = isset($_SESSION['user_email']) && $_SESSION['user_email'] !== null;
    $query = "SELECT user_nama FROM user WHERE user_email = '".$_SESSION['user_email']."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_nama = $row['user_nama'];
    $_GET['user_nama'] = $user_nama;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVH Tickets</title>
    <link rel="stylesheet" href="asset/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
</head>
<body>  
    <div id="navbar">
        <nav>
            <div class="logo"><img src="asset/img/AVH_white.png" alt="Logo" onclick="window.location.href='index.php'"></div>
            <div class="openMenu"><i class="fa fa-bars"></i></div>
            <ul class="mainMenu">
                <li><a href="index.php">Home</a></li>
                <li><a href="ticket.php">Ticket</a></li>
                <?php
                    if (isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@gmail.com') {
                        echo '<li><a href="inputdata.php">Input</a></li>';
                    }
                ?> 
                <li><a href="#">About</a></li>
                <li id='pencarian'>
                    <form action="search.php" method="post">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <button type="submit" id="searchb"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                    </form>
                </li>
                <!-- <li><a href="conf/logout.php" class="nav-link">Logout</a></li> -->
                <div class="closeMenu"><i class="fa fa-times"></i></div>
                <span class="icons">
                    <i class="fab fa-github"></i>
                </span>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fa-solid fa-user"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <?php if ($isLoggedIn): ?>
                            <li><a href="#" class="nav-link"><?php echo $_GET['user_nama'];?></a></li>
                            <li><a href="#" class="nav-link">Riwayat</a></li>
                            <li><a href="conf/logout.php" class="nav-link">Logout</a></li>
                        <?php else: ?>
                            <li><a href="masuk.php" class="nav-link">Login</a></li>
                        <?php endif; ?>
                    </div>
                </div>
            </ul>
        </nav>
    </div>

    <div id="daftar_konser">
        <h1>Daftar Konser</h1>
        <ul>
            <?php
            $query = "SELECT * FROM data_konser order by tanggal ASC";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                $concert_id = $row['datakonser_id'];
                // Convert date to desired format
                $date = strtotime($row['tanggal']);
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
                            <td>Rp." . number_format($row['harga_min'], 0, ',', '.')."- Rp.". number_format($row['harga_max'], 0, ',', '.') . "</td>
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