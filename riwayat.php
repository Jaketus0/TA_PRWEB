<?php
include 'conf/connection.php';
session_start();

$isLoggedIn = isset($_SESSION['user_email']) && $_SESSION['user_email'] !== null;
if ($isLoggedIn) {
    $stmt = $conn->prepare("SELECT user_nama FROM user WHERE user_email = ?");
    $stmt->bind_param('s', $_SESSION['user_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_nama = htmlspecialchars($row['user_nama'], ENT_QUOTES, 'UTF-8');
    }
    $stmt->close();
} else {
    // Redirect to login page if not logged in
    header("Location: masuk.php");
    exit();
}

// Handle cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_id'])) {
    $cancel_id = $_POST['cancel_id'];

    // Get the ticket details to update the stock
    $stmt = $conn->prepare("SELECT jenis_tiket, jumlah_tiket FROM invoice WHERE pemesanan_id = ?");
    $stmt->bind_param('i', $cancel_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $jenis_tiket = $row['jenis_tiket'];
        $jumlah_tiket = $row['jumlah_tiket'];

        // Update the stock
        $updateStmt = $conn->prepare("UPDATE jenis_tiket SET stock = stock + ? WHERE jenis = ?");
        $updateStmt->bind_param('is', $jumlah_tiket, $jenis_tiket);
        $updateStmt->execute();
        $updateStmt->close();
    }
    $stmt->close();

    // Delete the invoice
    $deleteStmt = $conn->prepare("DELETE FROM invoice WHERE pemesanan_id = ?");
    $deleteStmt->bind_param('i', $cancel_id);
    $deleteStmt->execute();
    $deleteStmt->close();
    
    // Redirect to avoid form resubmission
    header("Location: riwayat.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
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
                    if ($isLoggedIn && $_SESSION['user_email'] === 'admin@gmail.com') {
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
                <div class="closeMenu"><i class="fa fa-times"></i></div>
                <span class="icons">
                    <i class="fab fa-github"></i>
                </span>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fa-solid fa-user"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <?php if ($isLoggedIn): ?>
                            <li><a href="#" class="nav-link"><?php echo $user_nama; ?></a></li>
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
    <div class="daftar_riwayat">
        <div class="isi_riwayat">
            <h1>Riwayat</h1>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Nama Konser</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah Tiket</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php
                    $no = 1;
                    $stmt = $conn->prepare("SELECT * FROM invoice WHERE user_email = ?");
                    $stmt->bind_param('s', $_SESSION['user_email']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row['nama_pembeli']."</td>";
                        echo "<td>".$row['user_email']."</td>";
                        echo "<td>".$row['no_tlp']."</td>";
                        echo "<td>".$row['nama_konser']."</td>";
                        echo "<td>".$row['jenis_tiket']."</td>";
                        echo "<td>".$row['jumlah_tiket']."</td>";
                        echo "<td>".$row['total_harga']."</td>";
                        echo "<td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='cancel_id' value='".$row['pemesanan_id']."'>
                                    <button type='submit' onclick=\"return confirm('Anda yakin ingin membatalkan pesanan ini?');\">Cancel</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    $stmt->close();
                ?>
            </table>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/ef9e5793a4.js" crossorigin="anonymous"></script>
<script src="asset/js/script.js"></script>
</html>
