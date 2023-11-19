<?php
include '../config/connection.php';

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $spesifikasi = $_POST['spesifikasi'];

    // Cek apakah gambar diubah atau tidak
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $gambar_temp = $_FILES['gambar']['tmp_name'];

        // Upload gambar baru
        move_uploaded_file($gambar_temp, "../uploads/" . $gambar);
    } else {
        // Jika gambar tidak diubah, gunakan gambar lama
        $gambar = $_POST['gambar_lama'];
    }

    $sql = "UPDATE barang SET
            harga = '$harga',
            detail_produk = '$keterangan',
            spesifikasi = '$spesifikasi',
            gambar = '$gambar'
            WHERE nama_barang = '$nama'"; // Menggunakan nama_barang sebagai identifier

    if ($koneksi->query($sql) === TRUE) {
        echo "Data produk berhasil diperbarui.";
        header("Location: ../product.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>
