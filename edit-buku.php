<?php
session_start();
($_SESSION['id'] == null ? header("Location: index.php") : "")
?>
<!doctype html>
<html class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/style.css" rel="stylesheet">
    <title>Edit Buku</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <?php
    include 'config/koneksi.php';

    // Mendapatkan ID dari URL
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $id = end($parts);

    // Membuat query menggunakan parameter binding untuk menghindari SQL injection
    $query = "SELECT id, judul, penerbit, penulis,deskripsi, tahun_terbit FROM buku WHERE id=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah query berhasil dieksekusi
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Mengambil data dari hasil query

        // Menutup koneksi setelah selesai menggunakan
        $stmt->close();
        $koneksi->close();
    } else {
        echo "Data tidak ditemukan."; // Menampilkan pesan jika data tidak ditemukan
        // Menutup koneksi karena tidak ada data yang diambil
        $stmt->close();
        $koneksi->close();
        exit(); // Keluar dari script karena data tidak ditemukan
    }
    ?>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Ubah Data Buku</h2>
            <form id="editBukuForm">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>" id="idBuku">
                    <div class="sm:col-span-2">
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                        <input value="<?= $data['judul']; ?>" type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                        <input value="<?= $data['penulis']; ?>" type=" text" name="penulis" id="penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="w-full">
                        <label for="penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                        <input value="<?= $data['penerbit']; ?>" type=" text" name="penerbit" id="penerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="w-full">
                        <label for="tahun_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit</label>
                        <input value="<?= $data['tahun_terbit']; ?>" type=" number" name="tahun_terbit" id="tahun_terbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="deskripsi" id=" deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><?= $data['deskripsi']; ?></textarea>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Simpan
                </button>
                <a href="/buku.php" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                    Batal
                </a>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const formEdit = document.getElementById('editBukuForm'); // Menggunakan ID dari form edit

        formEdit.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const xhr = new XMLHttpRequest();
                const formData = new FormData(formEdit);

                // Mengatur endpoint yang sesuai untuk update data
                xhr.open('POST', '/buku/update.php', true);

                xhr.onreadystatechange = () => {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.response)
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Sukses",
                                    text: response.message
                                }).then((result) => {
                                    console.log(response.message);
                                    if (result.isConfirmed || result.isDismissed) {
                                        window.location.href = '/buku.php'
                                    }
                                })

                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Ups...",
                                    text: response.message
                                });
                                console.log('Gagal mengupdate buku:', response.message);
                            }
                        } else {
                            console.log('Kesalahan: ', xhr.status);
                        }
                    }
                };

                xhr.send(formData);
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    </script>
</body>

</html>