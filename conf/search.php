<?php
include 'connection.php';

// Get the search query from the form
$searchQuery = isset($_POST['search']) ? trim($_POST['search']) : '';

// Ensure query has two placeholders
$query = "SELECT * FROM daftarkonser WHERE nama_konser LIKE '%?%' OR kota LIKE '%?%'";

// Prepare the statement
$stmt = mysqli_prepare($conn, $query);

// **Verify only two variables are being bound**
mysqli_stmt_bind_param($stmt, "ss", $searchQuery, $searchQuery);  // Ensure two elements

// **Print $searchQuery for debugging**
// echo $searchQuery; // Uncomment for debugging

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Close the statement
mysqli_stmt_close($stmt);

$count = mysqli_num_rows($result);

if ($count > 0) {
  echo '<ul>';
  while ($row = mysqli_fetch_assoc($result)) {
    $concertId = $row['id_konser'];
    $date = strtotime($row['tgl_konser']);
    $formattedDate = date('d F Y', $date);

    echo "<li data-concert-id='$concertId'>
            <img src='asset/tmp/cover/" . $row['gambar'] . "' alt='" . $row['nama_konser'] . "'>
            <div class='details'>
              <h3>" . $row['nama_konser'] . "</h3>
              <table>
                <tr>
                  <td>Tanggal</td>
                  <td>&nbsp;:&nbsp;</td>
                  <td>" . $formattedDate . "</td>
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
  echo '</ul>';
} else {
  echo '<p>No concerts found matching your search.</p>';
}

// Close connection (assuming it's not done elsewhere in your code)
mysqli_close($conn);
?>
