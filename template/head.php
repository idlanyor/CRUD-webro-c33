<?php
session_start();
($_SESSION['id'] == null ? header("Location: index.php") : "")
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD Buku | Roidev</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://flowbite.com/docs/images/logo.svg" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 h-screen">
    