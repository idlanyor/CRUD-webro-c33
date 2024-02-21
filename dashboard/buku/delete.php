<?php
// proses/hapus-buku.php
include '../config/koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_buku = $_POST['id']; // Ubah sesuai dengan nama input dari form atau cara yang Anda gunakan

    // Jalankan query untuk menghapus data buku dari database
    $stmt = $koneksi->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id_buku);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Data buku berhasil dihapus.'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Gagal menghapus data buku.'
        ];
        echo json_encode($response);
    }

    $stmt->close();
} else {
    // Tangani jika ada akses yang tidak sah ke endpoint ini
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Metode tidak diizinkan']);
}
