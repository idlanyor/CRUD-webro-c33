<?php
include 'koneksi.php';

// Fungsi untuk melakukan peminjaman buku
function pinjamBuku($id_buku, $id_mahasiswa, $tanggal_pinjam, $tanggal_kembali, $conn)
{
    $stmt = $conn->prepare("INSERT INTO peminjaman_buku (id_buku, id_mahasiswa, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_buku, $id_mahasiswa, $tanggal_pinjam, $tanggal_kembali);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
}

// Fungsi untuk mengambil semua data peminjaman
function ambilSemuaPeminjaman($conn)
{
    $result = $conn->query("SELECT id, id_buku, id_mahasiswa, tanggal_pinjam, tanggal_kembali FROM peminjaman_buku");
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Fungsi untuk mengubah informasi peminjaman
function ubahPeminjaman($id, $id_buku, $id_mahasiswa, $tanggal_pinjam, $tanggal_kembali, $conn)
{
    $stmt = $conn->prepare("UPDATE peminjaman_buku SET id_buku=?, id_mahasiswa=?, tanggal_pinjam=?, tanggal_kembali=? WHERE id=?");
    $stmt->bind_param("iissi", $id_buku, $id_mahasiswa, $tanggal_pinjam, $tanggal_kembali, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
}

// Fungsi untuk menghapus peminjaman berdasarkan ID
function hapusPeminjaman($id, $conn)
{
    $stmt = $conn->prepare("DELETE FROM peminjaman_buku WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
}

// Menutup koneksi setelah selesai menggunakan
$conn->close();
