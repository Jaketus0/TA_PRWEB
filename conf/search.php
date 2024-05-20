<?php
  
  include '../conf/connection.php';
  $search_term = "";
  if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
  }
  $filtered_concerts = [];
  if ($search_term) {
    $search_query = "SELECT * FROM daftarkonser WHERE nama_konser LIKE '%$search_term%' OR kota LIKE '%$search_term%' OR tgl_konser LIKE '%$search_term%'";
    $filtered_result = mysqli_query($conn, $search_query); 
    if (mysqli_num_rows($filtered_result) > 0) {
      $filtered_concerts = mysqli_fetch_all($filtered_result, MYSQLI_ASSOC);
    }
  }  
  global $filtered_concerts;
?>
