<?php
include '../config/koneksi.php';

// Ambil data dari permintaan POST
$id = $_POST['id'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$deskripsi = $_POST['deskripsi'];

// Query SQL untuk update data
$sql = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', deskripsi='$deskripsi' WHERE id=$id";

if ($koneksi->query($sql) === TRUE) {
    $response = array(
        "success" => true,
        "message" => "Data buku berhasil diperbarui."
    );
    echo json_encode($response);
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal memperbarui data buku: " . $koneksi->error
    );
    echo json_encode($response);
}

$koneksi->close();
