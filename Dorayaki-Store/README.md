# Web Doraemonangis for Buying Dorayaki
Web Untuk Tugas Besar 1 IF3110 Pengembangan Aplikasi Berbasis Web
* [Deskripsi Aplikasi Web](#deskripsi-aplikasi-web)
* [Requirement](#requirement)
* [Cara Menjalankan Server](#cara-menjalankan-server)
* [Screenshot](#screenshot)
* [Pembagian Tugas](#pembagian-tugas)

## Deskripsi Aplikasi Web
Web ini adalah web yang ditujukan untuk pengerjaan Tugas Besar IF3110 2021
Web ini dapat melakukan:
1. Login
2. Register akun baru
3. Menambah dan menghapus varian dorayaki (admin-only)
4. Melihat daftar varian dorayaki
5. Melihat detail dari sebuah varian dorayaki
6. Melakukan pencarian nama varian dorayaki
7. Mengubah stok dorayaki (admin-only)
8. Membeli dorayaki
9. Melihat riwayat pembelian dorayaki
10. Melihat riwayat perubahan stok dorayaki (admin-only)

## REQUIREMENT
Untuk menjalankan web ini diperlukan instalasi:
- sqlite3
- php
- docker

## CARA MENJALANKAN SERVER
Cara menjalankan server
1. Buka command prompt, lalu jalankan (pastikan current directory berada sama dengan file docker-compose.yml)
```sh
docker-compose up
```
2. Buka web browser lalu masukkan url
```sh
localhost:80/dashboard.php
```

## SCREENSHOT
Screenshot dapat dilihat pada folder screenshot

## PEMBAGIAN TUGAS
SERVER-SIDE\
Login: 13519109, 13519005\
Register: 13519109, 13519005\
Dashboard: 13519195\
Pembelian Dorayaki: 13519195\
Tambah Varian Dorayaki: 13519195\
Detail Dorayaki: 13519195\
Searching: 13519005
Riwayat Pengubahan Stok dan Pembelian: 13519195\
CLIENT-SIDE\
Dashboard: 13519195\
Login: 13519109, 13519005, 13519195\
Register: 13519109, 13519005\
Dashboard: 13519195, 13519005\
Pembelian Dorayaki: 13519195\
Tambah Varian Dorayaki: 13519195\
Detail Dorayaki: 13519195\
Searching: 13519005\
Riwayat Pengubahan Stok dan Pembelian: 13519195
DOCKER\ = 13519109
