<?php
include '../config/connection.php';  // Sesuaikan path file connection.php

if (isset($_GET['nama_barang'])) {
    $nama = $_GET['nama_barang'];

    // Lakukan penghapusan data
    $sql = "DELETE FROM barang WHERE nama_barang = '$nama'";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data produk berhasil dihapus.";
        header("Location: ../product.php");
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    echo "Nama barang tidak valid.";
}
exit();

mysqli_close($koneksi);
?>
