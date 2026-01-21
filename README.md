# Sistem Manajemen Event & Volunteer Mahasiswa

Website manajemen event dan volunteer mahasiswa berbasis PHP native, MySQL, HTML, CSS, dan JavaScript.

## Persyaratan

- PHP 7.4+
- MySQL 5.7+
- XAMPP atau server lokal lainnya

## Instalasi

1. Clone atau download proyek ini ke folder htdocs XAMPP (misal: C:\xampp\htdocs\student_event_volunteer_system)

2. Buat database MySQL bernama `student_event_volunteer_db`

3. Import schema database dari `config/database.php` (uncomment bagian schema creation dan jalankan sekali)

4. Pastikan koneksi database di `config/database.php` sesuai dengan setting MySQL Anda

5. Akses website di `http://localhost/student_event_volunteer_system`

## Struktur Folder

- `config/` - Konfigurasi database
- `auth/` - Login, logout, register
- `admin/` - Halaman admin
- `user/` - Halaman user
- `assets/css/` - Stylesheet
- `assets/js/` - JavaScript
- `assets/img/` - Gambar (tambahkan gambar event_kompetisi.jpg, event_seminar.jpg, volunteer.jpg)
- `views/` - Komponen UI reusable (belum digunakan)

## Fitur

- **Homepage**: Tampilan utama dengan card event dan volunteer
- **Autentikasi**: Login, register, logout dengan session
- **Admin Dashboard**: Kelola event, volunteer, kategori, verifikasi pendaftaran, upload dokumentasi
- **User Dashboard**: Lihat dan daftar event/volunteer, lihat status pendaftaran
- **Profil**: Edit profil user
- **Portofolio**: Riwayat partisipasi dan pencapaian
- **Kategori**: Filter event berdasarkan kategori

## Default Akun

- Admin: Buat akun dengan role admin secara manual di database atau register lalu update role
- User: Register melalui halaman register

## Catatan

- Pastikan folder `assets/uploads/` memiliki permission write untuk upload dokumentasi
- Tambahkan gambar di `assets/img/` untuk tampilan yang lebih baik
- Website responsif dan menggunakan tema biru

## Lisensi

Proyek ini untuk tujuan edukasi.
