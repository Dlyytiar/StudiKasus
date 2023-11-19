<?php
include "../config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $keterangan = $_POST["keterangan"];
    $spesifikasi = $_POST["spesifikasi"];

    $gambar = null;
    if (isset($_FILES["gambar"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($_FILES["gambar"]["size"] > 5000000) {
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" &&
            $imageFileType != "png" &&
            $imageFileType != "jpeg"
        ) {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar = $target_file;
                echo "Path Gambar: " . $gambar;
            }
        }
    }

    $query = "INSERT INTO barang (nama_barang, harga, detail_produk, spesifikasi, gambar) VALUES ('$nama', '$harga', '$keterangan', '$spesifikasi', '$gambar')";

    if (mysqli_query($koneksi, $query)) {
        echo "Produk berhasil ditambahkan.";
        header("Location: ../product.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }    

    mysqli_close($koneksi);
}
?>
