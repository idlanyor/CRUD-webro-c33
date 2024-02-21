<?php
// proses/crud-buku.php
include '../config/koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $deskripsi = $_POST['deskripsi'];

    // Lakukan validasi data jika diperlukan

    // Jalankan query untuk memasukkan data buku ke dalam database
    $stmt = $koneksi->prepare("INSERT INTO buku (judul, penulis, penerbit,deskripsi, tahun_terbit) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $judul, $penulis, $penerbit, $deskripsi, $tahun_terbit);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Data buku berhasil ditambahkan.'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Gagal menambahkan data buku.'
        ];
        echo json_encode($response);
    }

    $stmt->close();
} else {
    // Tangani jika ada akses yang tidak sah ke endpoint ini
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Metode tidak diizinkan']);
}
