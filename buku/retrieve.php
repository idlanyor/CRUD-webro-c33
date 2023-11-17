<?php
include '../config/koneksi.php';

$result = $koneksi->query("SELECT id, judul, penerbit, penulis,deskripsi, tahun_terbit FROM buku");
if ($result->num_rows > 0) {
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
} else {
    echo [];
}

// Menutup koneksi setelah selesai menggunakan
$koneksi->close();
