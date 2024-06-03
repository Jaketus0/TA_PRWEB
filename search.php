<?php
include 'conf/connection.php';
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>
            alert('You must login first!');
            window.location.href='index.php';
          </script>";
    exit(); 
}

if (isset($_POST['search'])) {
    $search_term = mysqli_real_escape_string($conn, trim($_POST['search']));

    
    if (preg_match("/^[a-zA-Z]+$/", $search_term)) {
        $search_month = date('m', strtotime($search_term)); 
        $search_query = "SELECT * FROM daftarkonser
                          WHERE nama_konser LIKE ?
                          OR MONTH(tgl_konser) = ?"; 

        if (strlen($search_term) > 2) { 
            $search_query .= " OR kota LIKE ?"; 
        }

        $stmt = mysqli_prepare($conn, $search_query);
        $bind_params = [];
        $bind_params_type = "";

        $bind_params[] = "%" . $search_term . "%";
        $bind_params_type .= "s";

        if ($search_month > 0) { 
            $bind_params[] = $search_month;
            $bind_params_type .= "i";
        }

        if (strlen($search_term) > 2) { 
            $bind_params[] = "%" . $search_term . "%";
            $bind_params_type .= "s";
        }

        mysqli_stmt_bind_param($stmt, $bind_params_type, ...$bind_params);

    } else { 
        $search_date_parts = explode(" ", $search_term);

        if (count($search_date_parts) === 2) {
            $search_day = (int) $search_date_parts[0];
            $search_month = date('m', strtotime($search_date_parts[1]));

            $search_query = "SELECT * FROM daftarkonser
                              WHERE DAY(tgl_konser) = ?
                              AND MONTH(tgl_konser) = ?";
            $stmt = mysqli_prepare($conn, $search_query);
            mysqli_stmt_bind_param($stmt, "ii", $search_day, $search_month);
        } else {
            echo "<script>
                    alert('Invalid search format. Please enter either concert name, month name (e.g., June), or date as day month (e.g., 26 June).');
                  </script>";
            header("Location: home.php");
            exit();
        }
    }

    mysqli_stmt_execute($stmt);
    $search_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($search_result) === 0) {
        echo "<script>
                alert('No concerts found for your search term.');
              </script>";
    }
} else {
    
    $query = "SELECT * FROM daftarkonser";
    $result = mysqli_query($conn, $query);
}

mysqli_close($conn);
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
  <nav>
    <div class="logo"><img src="asset/img/AVH gray.png" alt="Logo" onclick="window.location.href='home.php'"></div>
    <div class="openMenu"><i class="fa fa-bars"></i></div>
    <ul class="mainMenu">
      <li><a href="home.php">Home</a></li>
      <li><a href="ticket.php">Ticket</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php
          if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com') {
            echo '<li><a href="inputdata.php">Input</a></li>';
          }
      ?> 
      <!-- <li><a href="#">About</a></li> -->
      <li>
          <form action="search.php" method="post">
            <input type="text" name="search" id="search" placeholder="Search">
            <button type="submit" id="searchb"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
          </form>
      </li>
      <li class="nav-item"><a href="conf/logout.php" class="nav-link">Logout</a></li>
      <div class="closeMenu"><i class="fa fa-times"></i></div>
      <span class="icons">
          <i class="fab fa-github"></i>
      </span>
    </ul>
  </nav>
  </div>
  <div id="daftar_konser">
    <h1>Daftar Konser</h1>
    <ul>
      <?php
        
        if (isset($_POST['search'])) {
          $count = mysqli_num_rows($search_result);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($search_result)) {
              $concert_id = $row['id_konser'];
              $date = strtotime($row['tgl_konser']);
              $formatted_date = date('d F Y', $date);

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
          } else {
            echo "<li>No concerts found for your search term.</li>";
          }
        } else {
          
          $count = mysqli_num_rows($result);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              
            }
          } else {
            echo "<li>No concerts found.</li>";
          }
        }
      ?>
    </ul>
  </div>
</body>
<script src="https:
<script src="asset/js/script.js"></script>
</html>
