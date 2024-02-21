<?php

// Definisikan rute
$routes = [
    '/' => 'login.php',
    '/mahasiswa' => 'dashboard/mahasiswa.php',
    '/buku' => 'dashboard/buku.php',
    '/barang' => 'dashboard/buku.php',
    '/logout' => 'dashboard/logout.php',
    // endpoint buku
    '/buku/list' => 'dashboard/buku/retrieve.php',
    '/buku/store' => 'dashboard/buku.php',
    '/buku/update' => 'dashboard/buku.php',
    '/buku/update' => 'dashboard/buku.php',
    '/buku/delete' => 'dashboard/buku.php',
    '/buku/edit/(\d+)' => function ($id) {
        // Panggil fungsi atau tampilkan file yang sesuai
        include 'dashboard/buku/edit-buku.php';
        // Anda dapat menggunakan $id di dalam file edit.php
    },  
];
