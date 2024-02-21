<?php
session_start();
include 'config/dbFun.php';
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $user = $_POST['username'];
        $pass = $_POST['password'];
        // var_dump($user);
        $query = "SELECT * FROM user WHERE username=? AND password=?";

        $result = dbGetQuery($query, "ss", $user, $pass);

        if ($result !== false && $result->num_rows > 0) {
            $user_sess = $result->fetch_assoc();
            $_SESSION["username"] = $user_sess["username"];
            $_SESSION["id"] = $user_sess["id"];
            $response = [
                'status'   => 'success',
                'message'  => 'Login berhasil !.Klik OK untuk melanjutkan...',
                'redirect' => '/buku'
            ];
        } else {
            $response = [
                'status'  => 'error',
                'message' => 'Username atau password salah!',
            ];
        }
    } else {
        $response = [
            'status'  => 'error',
            'message' => 'Permintaan tidak valid. Pastikan semua data diterima.',
        ];
    }
} else {
    $response = [
        'status'  => 'error',
        'message' => 'Method tidak valid',
    ];
}

header('Content-Type: application/json'); 
echo json_encode($response);
