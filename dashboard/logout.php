<?php
session_start();
$_SESSION = array(); // Hapus variabel sesi
session_destroy();
?>
<!-- Letakkan ini di atas skrip SweetAlert2 -->
<link href="/assets/style.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: "success",
            title: "Terima kasih !",
            text: "Logout Berhasil"
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = "/";
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>