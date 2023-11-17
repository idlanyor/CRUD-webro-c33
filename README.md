<img src="https://avatars.githubusercontent.com/u/67109815?s=200&v=4" alt="Tailwind CSS" width="100"/> | <img src="https://camo.githubusercontent.com/46fcf83d0b41814e6a640808d16ed92866674fd38b78bc67fb727ac93e513eae/68747470733a2f2f666c6f77626974652e73332e616d617a6f6e6177732e636f6d2f6769746875622f6c6f676f2d6769746875622e706e67" alt="Flowbite" width="100"/> | <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Unofficial_JavaScript_logo_2.svg/1200px-Unofficial_JavaScript_logo_2.svg.png" alt="JavaScript" width="100"/> | <img src="https://www.cdnlogo.com/logos/p/71/php.svg" alt="PHP" width="100"/> | <img src="https://www.cdnlogo.com/logos/m/10/mysql.svg" alt="MySQL" width="100"/>


# CRUD Web Programming Project

Ini adalah proyek tugas mata kuliah Web Programming yang bertujuan untuk mengimplementasikan CRUD (Create, Read, Update, Delete) untuk entitas Buku, Mahasiswa, dan Barang menggunakan PHP, MySQL, serta menggunakan Tailwind CSS dan Flowbite untuk tampilan antarmuka.


## Demo
Demo proyek dapat diakses melalui [tautan ini](https://crud.roynaldi.skom.id/).

## Fitur yang Tersedia
- CRUD Buku
- CRUD Mahasiswa (Akan Datang)
- CRUD Barang (Akan Datang)
- Toggle Dark/Light Mode (Belum menggunakan localStorage)

## Teknologi yang Digunakan
- PHP
- MySQL
- Tailwind CSS
- Flowbite

## Prerequisites
Pastikan komputer Anda telah terinstal:
- Web server seperti Apache atau Nginx
- PHP versi 7.x ke atas
- MySQL atau database server lainnya
- Text editor atau IDE untuk mengedit kode

## Cara Instalasi
Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah di bawah ini:

1. Clone repositori ke dalam direktori web server Anda:
   ```bash
   git clone https://github.com/roynaldi3301/tugas-crud-webpro.git
   ```

2. Import database yang disediakan ke dalam MySQL:
   - Buka MySQL dan buatlah database baru (misalnya, dengan nama `crud_db`).
   - Import skema yang disediakan ke dalam database yang baru dibuat.

3. Konfigurasi Koneksi Database:
   - Buka file `config/koneksi.php` dan ubah informasi koneksi database sesuai dengan konfigurasi Anda:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "nama_database";
     ```

4. Akses Proyek melalui Browser:
   - Buka browser dan akses `http://localhost/path-to-project/`.

5. Gunakan Akun Berikut untuk Akses Admin:
   - Username: `roidev`
   - Password: `roidev`

Konfigurasi  [tailwindcss klik disini](https://tailwindcss.com/docs/installation)
 
## Fitur Teknis
- CRUD dengan AJAX XMLHttpRequest untuk memisahkan UI dan logika bisnis.
- Alert interaktif dengan SweetAlert2.
- Antisipasi SQL injection dengan penggunaan prepared statement.

## Catatan Tambahan
- Fitur Mahasiswa dan Barang masih dalam pengembangan.

Silakan hubungi saya jika ada pertanyaan atau masukan terkait proyek ini.

Terima kasih!
