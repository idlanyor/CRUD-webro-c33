<?php
require_once 'const.php';
session_start();
if (isset($_SESSION['id'])) {
    header("Location: /dashboard/buku.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/style.css" rel="stylesheet">
    <title>Login | Roidev</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                CRUD Roidev
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login untuk melanjutkan
                    </h1>
                    <div class="text-center">
                        <p>username : roidev</p>
                        <p>password : roidev</p>
                    </div>
                    <form class="space-y-4 md:space-y-6" id="formLogin">
                        <div class="relative">
                            <input value="roidev" type="text" name="username" id="username" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="username" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Username</label>
                        </div>
                        <div class="relative">
                            <input value="roidev" type="password" name="password" id="floating_filled" class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="floating_filled" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password</label>
                        </div>
                        <button type="submit" class="w-full rounded-b-lg text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium text-md px-5 py-4 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let formLogin = document.getElementById('formLogin')
            formLogin.addEventListener('submit', (e) => {
                e.preventDefault();
                let loginData = new FormData(formLogin)
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "login-proses.php", true)
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let response = JSON.parse(xhr.response)
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Yuhuu...",
                                    text: response.message
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        window.location.href = response.redirect; // Pengalihan halaman setelah tombol "OK" ditekan
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Ups...",
                                    text: response.message
                                });
                            }
                        } else {
                            console.error('Terjadi kesalahan: ' + xhr.status);
                        }
                    }
                }
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.send(new URLSearchParams(loginData));
            })
        })
    </script>
</body>

</html>