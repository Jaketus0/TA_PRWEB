<?php
include 'conf/connection.php';
session_start();
$isLoggedIn = isset($_SESSION['email']) && $_SESSION['email'] !== null;

$concertId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "SELECT nama_konser FROM data_konser WHERE datakonser_id = ?";

try {
    if ($concertId) {
        $stmt_concert = $conn->prepare($sql);
        $stmt_concert->bind_param("i", $concertId);
        $stmt_concert->execute();
        $result_concert = $stmt_concert->get_result();
        $row_concert = $result_concert->fetch_assoc();
        $concertName = $row_concert['nama_konser'];
        
        $sql_ticket = "SELECT jenis, harga, stock FROM jenis_tiket WHERE datakonser_id = ?";
        $stmt_ticket = $conn->prepare($sql_ticket);
        $stmt_ticket->bind_param("i", $concertId);
        $stmt_ticket->execute();
        $result_ticket = $stmt_ticket->get_result();
        $ticketTypes = array(); 

        while ($row_ticket = $result_ticket->fetch_assoc()) {
            $ticketTypes[] = $row_ticket; 
        }

        usort($ticketTypes, function($a, $b) {
            return $a['harga'] - $b['harga'];
        });
    }

    $stmt_concert->close();
    $stmt_ticket->close();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the selected ticket type and quantity from the form
        $selectedTicket = $_POST['jenistiket'];
        $selectedQuantity = $_POST['jumlah'];

        // Get the stock quantity for the selected ticket type
        $stockQuantity = 0;
        foreach ($ticketTypes as $ticket) {
            if ($ticket['jenis'] === $selectedTicket) {
                $stockQuantity = $ticket['stock'];
                break;
            }
        }

        // Compare the selected quantity with the available stock
        if ($selectedQuantity > $stockQuantity) {
            // If selected quantity exceeds available stock, display an alert
            $errorMessage = "Sorry, the selected quantity exceeds the available stock for this ticket type.";
        } else {
            // If quantity is within available stock, proceed with booking
            // Insert booking details into the invoice table
            $namaPemesan = $_POST['nama_pemesan'];
            $noTlpPemesan = $_POST['tlp_pemesan'];
            $emailPemesan = $_POST['email_pemesan'];
            $datakonserId = $concertId;
            $harga = 0;
            foreach ($ticketTypes as $ticket) {
                if ($ticket['jenis'] === $selectedTicket) {
                    $harga = $ticket['harga'];
                    break;
                }
            }
            $totalHarga = $harga * $selectedQuantity;

            $sql_insert = "INSERT INTO invoice (nama_pembeli, jumlah_tiket, jenis_tiket, nama_konser, user_id, datakonser_id, no_tlp, user_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("siisiiis", $namaPemesan, $selectedQuantity, $selectedTicket, $concertName, $_SESSION['user_id'], $datakonserId, $noTlpPemesan, $emailPemesan);
            $stmt_insert->execute();
            $stmt_insert->close();

            // Generate invoice for the user
            $invoiceMessage = "Thank you for your booking!\n\n";
            $invoiceMessage .= "Concert: " . $concertName . "\n";
            $invoiceMessage .= "Ticket Type: " . $selectedTicket . "\n";
            $invoiceMessage .= "Quantity: " . $selectedQuantity . "\n";
            $invoiceMessage .= "Unit Price: " . $harga . "\n";
            $invoiceMessage .= "Total Price: " . $totalHarga . "\n";

            // You can further customize the invoice message as needed

            // Display invoice message to the user
            echo "<script>alert('" . $invoiceMessage . "');</script>";
            $errorMessage = ""; // Clear the error message after successful booking
        }
    } else {
        // If the form is not submitted, initialize the error message
        $errorMessage = "";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
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
    <div id="inputdata">
        <div class="form_input">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $concertId; ?>" method="post" enctype="multipart/form-data">
                <table>
                <tr>
                    <td><label for="nama_pemesan">Nama </label></td>
                    <td>: <input type="text" name="nama_pemesan" id="nama_pemesan" required></td>
                </tr>
                <tr>
                    <td><label for="tlp_pemesan">No Tlp</label></td>
                    <td>: <input type="number" name="tlp_pemesan" id="tlp_pemesan" required></td>
                </tr>
                <tr>
                    <td><label for="email_pemesan">E-Mail</label></td>
                    <td>: <input type="email" name="email_pemesan" id="email_pemesan" required></td>
                </tr>
                <tr>
                    <td><label for="jenistiket">Pilih Tiket</label></td>
                    <td>: 
                    <select name="jenistiket" id="jenistiket" required>
                        <option value="" selected disabled>Pilih Jenis Tiket</option>
                        <?php foreach ($ticketTypes as $type): ?>
                            <option value="<?php echo $type['jenis']; ?>"><?php echo $type['jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="jumlah">Jumlah</label></td>
                    <td>: <input type="number" name="jumlah" id="jumlah" value="1"  required></td>
                </tr>
                <tr>
                    <td id="errorStock"><p></p></td>
                </tr>
                <tr>
                    <td><label for="harga">Harga Satuan</label></td>  
                    <td>: <input type="text" name="harga" id="harga" disabled></td>
                </tr>
                <tr>
                    <td><label for="total">Total Harga</label></td>  
                    <td>: <input type="text" name="total" id="total" disabled></td>
                </tr>
                <tr>
                    <td><button class="button_pesan" type="submit" title="Lakukan Pemesanan">Submit</button></td>
                </tr>
                </table>
            </form>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/ef9e5793a4.js" crossorigin="anonymous"></script>
<script src="asset/js/script.js"></script>
</html>