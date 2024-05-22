<?php
  include 'conf/connection.php';
  // session_start();
    // if(!isset($_SESSION['email'])) {
    //     echo "<script>
    //         alert('You must login first!!');
    //         window.location.href='index.php';
    //         </script>";
    // }
  $concertId = $_GET['id'];  
  $query = "SELECT * FROM daftarkonser WHERE id_konser = $concertId";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $nama_konser = $row['nama_konser'];
    $tgl_konser = $row['tgl_konser'];
    $lokasi = $row['lokasi'];
    $kota = $row['kota'];
    $harga = $row['harga'];
    $gambar = $row['gambar'];
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
</head>
<body>
    <!-- <div id="navbar">
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
    </div> -->
    <div id="navbar">
        <div class="logo">
            <img src="asset/img/AVH.png" alt="Logo">
            <ul>
                <li><a href="home.php">Home</a></li>    
                <li><a href="ticket.php">Ticket</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><input type="text" id="search"></li>
                <li><a href="conf/logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
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
                    <td>:</td>
                    <td>Rp <?php echo $harga; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>