<?php
require 'routes.php';
function route($url)
{
    global $routes;

    // Iterasi melalui semua rute yang didefinisikan
    foreach ($routes as $pattern => $handler) {
        // Cek apakah pola rute cocok dengan URL yang diminta
        if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
            // Hapus elemen pertama (pola lengkap)
            array_shift($matches);
            // Panggil fungsi atau tampilkan file yang sesuai dengan pola
            if (is_callable($handler)) {
                call_user_func_array($handler, $matches);
            } else {
                include $handler;
            }
            return;
        }
    }

    // Jika tidak ada rute yang cocok, tampilkan halaman 404
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}

// Ambil URL yang diminta
$request_uri = $_SERVER['REQUEST_URI'];

// Hapus query string jika ada
$request_uri = strtok($request_uri, '?');

// Cari rute yang cocok dan tangani permintaan
route($request_uri);
