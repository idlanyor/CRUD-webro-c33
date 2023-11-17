<?php
include 'koneksi.php';

// Fungsi untuk menambahkan mahasiswa baru
function tambahMahasiswa($nim, $nama, $prodi, $jenjang, $semester, $conn)
{
    $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, prodi, jenjang, semester) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nim, $nama, $prodi, $jenjang, $semester);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
}

// Fungsi untuk mengambil semua data mahasiswa
function ambilSemuaMahasiswa($conn)
{
    $result = $conn->query("SELECT id, nim, nama, prodi, jenjang, semester FROM mahasiswa");
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Fungsi untuk mengubah informasi mahasiswa
function ubahMahasiswa($id, $nim, $nama, $prodi, $jenjang, $semester, $conn)
{
    $stmt = $conn->prepare("UPDATE mahasiswa SET nim=?, nama=?, prodi=?, jenjang=?, semester=? WHERE id=?");
    $stmt->bind_param("ssssii", $nim, $nama, $prodi, $jenjang, $semester, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
    $stmt->close();
}

// Fungsi untuk menghapus mahasiswa berdasarkan ID
function hapusMahasiswa($id, $conn)
{
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id=?");
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
