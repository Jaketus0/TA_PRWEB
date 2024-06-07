<?php
    include 'conf/connection.php';
    session_start();
    $isLoggedIn = isset($_SESSION['user_email']) && $_SESSION['user_email'] !== null;
//   if(!isset($_SESSION['user_email'])) {
//       echo "<script>
//           alert('You must login first!!');
//           window.location.href='index.php';
//           </script>";
//   }
    $concertId = $_GET['id'];  
    $query = "SELECT * FROM data_konser WHERE datakonser_id = $concertId";
    $result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $nama_konser = $row['nama_konser'];
    $tgl_konser = $row['tanggal'];
    $lokasi = $row['lokasi'];
    $kota = $row['kota'];
    $harga_max = $row['harga_max'];
    $harga_min = $row['harga_min'];
    $gambar = $row['gambar'];
    $deskripsi = $row['deskripsi'];
} else {
    echo "Concert not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konser Detail</title>
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
                            <li><a href="#" class="nav-link">Akun</a></li>
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
    <div class="konser-detail">
        <div class="gambar">
            <img src="asset/tmp/cover/<?php echo $gambar; ?>" alt="<?php echo $nama_konser; ?>">
        </div>
        <div class="details">
            <h2><?php echo $nama_konser; ?></h2>
            <table>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php echo date('d F Y', strtotime($tgl_konser)); ?></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?php echo $lokasi; ?></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>:</td>
                    <td><?php echo $kota; ?></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>Rp.<?php echo number_format($row['harga_min'], 0, ',', '.'); ?> - Rp.<?php echo number_format($row['harga_max'], 0, ',', '.'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><?php echo $deskripsi;?></td>
                </tr>

            </table>
        </div>
    </div>
    <div class="belibtn">
        <?php
        if ($isLoggedIn) {
            echo "<a href='pemesanan.php?id=$concertId'><b>Beli Tiket</b></a>";
        } else {
            $_SESSION['redirect_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo "<a href='masuk.php'><b>Login untuk membeli tiket</b></a>";
        }
        ?>
    </div>
</body>
<script src="https://kit.fontawesome.com/ef9e5793a4.js" crossorigin="anonymous"></script>
<script src="asset/js/script.js"></script>
</html>
