<?php
include 'connection.php'; // Koneksi ke database
session_start();

// Ambil data dari form
$nama_pemesan = $_POST['nama_pemesan'];
$tlp_pemesan = $_POST['tlp_pemesan'];
$email_pemesan = $_POST['email_pemesan'];
$jenistiket = $_POST['jenistiket'];
$jumlah = (int)$_POST['jumlah'];
$user_id = $_SESSION['user_id']; // Asumsikan user_id disimpan di session saat login

// Ambil data konser dan harga tiket dari database
$query_tiket = $conn->prepare("SELECT harga, datakonser_id, stock FROM jenis_tiket WHERE jenis = ?");
$query_tiket->bind_param('s', $jenistiket);
$query_tiket->execute();
$result_tiket = $query_tiket->get_result();
$tiket = $result_tiket->fetch_assoc();

$harga = $tiket['harga'];
$datakonser_id = $tiket['datakonser_id'];
$stock = $tiket['stock'];

// Cek stok tiket
if ($jumlah > $stock) {
    echo "Jumlah tiket yang dipesan melebihi stok yang tersedia.";
    exit;
}

// Hitung total harga
$total_harga = $harga * $jumlah;

// Insert data ke tabel invoice
$query_invoice = $conn->prepare("INSERT INTO invoice (nama_pembeli, jumlah_tiket, jenis_tiket, nama_konser, user_id, datakonser_id, no_tlp, user_email, total_harga) VALUES (?, ?, ?, (SELECT nama_konser FROM data_konser WHERE datakonser_id = ?), ?, ?, ?, ?, ?)");
$query_invoice->bind_param('sisiiissi', $nama_pemesan, $jumlah, $jenistiket, $datakonser_id, $user_id, $datakonser_id, $tlp_pemesan, $email_pemesan, $total_harga);
$query_invoice->execute();

// Kurangi stok tiket
$new_stock = $stock - $jumlah;
$query_update_stock = $conn->prepare("UPDATE jenis_tiket SET stock = ? WHERE jenis = ?");
$query_update_stock->bind_param('is', $new_stock, $jenistiket);
$query_update_stock->execute();

// Redirect ke index.php
header('Location: ../index.php');
exit;
?>
