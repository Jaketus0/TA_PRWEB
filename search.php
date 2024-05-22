<?php
  include 'conf/connection.php';

  // Search functionality
  if (isset($_POST['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search']);
    $search_query = "SELECT * FROM daftarkonser WHERE nama_konser LIKE '%$search_term%' OR tgl_konser LIKE '%$search_term%' OR kota LIKE '%$search_term%'";
    $search_result = mysqli_query($conn, $search_query);
  } else {
    // Default query to fetch all concerts if no search is performed
    $query = "SELECT * FROM daftarkonser";
    $result = mysqli_query($conn, $query);
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
      <img src="asset/img/AVH.png" alt="Logo">
      <ul>
        <li>
          <form action="search.php" method="post">
            <input type="text" name="search" id="search" placeholder="Search">
            <button type="submit" id="searchb"><i class="fas fa-magnifying-glass"></i></button>
          </form>
        </li>
        <li><a href="home.php">Home</a></li>   
        <li><a href="ticket.php">Ticket</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="conf/logout.php" class="logout">Logout</a></li>
      </ul>
    </div>
  </div>
  <div id="daftar_konser">
    <h1>Daftar Konser</h1>
    <ul>
      <?php
        // Display search results or all concerts based on search presence
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
          // Default output for all concerts if no search is performed
          $count = mysqli_num_rows($result);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              // ... (same concert details display as before) ...
            }
          } else {
            echo "<li>No concerts found.</li>";
          }
        }
      ?>
    </ul>
  </div>
</body>
<script src="https://kit.fontawesome.com/ef9e5793a4.js" crossorigin="anonymous"></script>
<script src="asset/js/script.js"></script>
</html>
