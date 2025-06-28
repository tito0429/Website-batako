# Sistem Pemesanan Batako Online

Aplikasi web untuk pemesanan batako secara online dengan antarmuka pengguna yang ramah.

## Teknologi Digunakan
- **Backend**: PHP
- **Frontend**: HTML, CSS, Bootstrap 5
- **Database**: MySQL
- **Server**: XAMPP/WAMP

## Fitur Utama
1. Form pemesanan dengan validasi lengkap
2. Penyimpanan data pelanggan dan pesanan
3. Relasi database antara tabel `pelanggan` dan `pesanan`
4. Antarmuka responsif dan user-friendly
5. Notifikasi pemesanan berhasil

## Cara Menjalankan
1. Pastikan XAMPP/WAMP terinstall
2. Import file `database.sql` ke phpMyAdmin
3. Simpan semua file ke folder `htdocs`
4. Akses melalui browser: `http://localhost/nama_folder/index.php`

## Screenshot Aplikasi
![alt text](<Screenshot 2025-06-28 190405.png>)
![alt text](<Screenshot 2025-06-28 190405-1.png>) 
![alt text](<Screenshot 2025-06-28 190405-2.png>) 
![alt text](<Screenshot 2025-06-28 190405-3.png>) 
![alt text](<Screenshot 2025-06-28 190418.png>) 
![alt text](<Screenshot 2025-06-28 190418-1.png>)
 ![alt text](<Screenshot 2025-06-28 190418-2.png>)



# Batako Online

## Deskripsi

Batako Online adalah sebuah aplikasi berbasis web menggunakan PHP dan MySQL yang digunakan untuk mengelola pemesanan batako secara online. Aplikasi ini menyediakan dua akses:

1. **User (Pelanggan)** - dapat melakukan pemesanan batako tanpa login.
2. **Admin** - dapat login untuk mengelola data pesanan, mencetak laporan, dan melakukan pengelolaan data.

## Fitur

### Untuk Pelanggan (User):

* Formulir pemesanan batako.
* Halaman konfirmasi/sukses setelah mengisi form.

### Untuk Admin:

* Login sebagai admin.
* Menampilkan daftar semua pesanan.
* Tambah, edit, dan hapus data pemesanan.
* Cetak laporan bulanan dalam format PDF.
* Cetak semua data pemesanan dalam format PDF.
* Logout admin.

## Struktur Folder

```
batako-online/
├── admin/
│   ├── index.php                # Halaman login admin
│   ├── daftar_pemesanan.php     # Halaman dashboard admin
│   ├── tambah_pesanan.php       # Form tambah data (admin)
│   ├── edit_pesanan.php         # Edit pesanan
│   ├── hapus_pesanan.php        # Hapus pesanan
│   ├── cetak_pdf_pesanan.php    # Cetak semua pesanan (PDF)
│   ├── laporan_pdf.php          # Cetak laporan bulanan (PDF)
│   ├── logout.php               # Logout admin
│   └── koneksi.php              # Koneksi database
├── vendor/                     # Folder hasil instalasi composer (dompdf)
├── index.php                   # Form pemesanan untuk pelanggan (tanpa login)
├── sukses.html                 # Halaman sukses setelah pemesanan
```

## Instalasi

1. Clone atau download repository ini ke folder server lokal Anda (misal: `htdocs/` untuk XAMPP atau `www/` untuk Laragon).
2. Buat database MySQL dengan nama `batako_online`.
3. Import file SQL yang sudah disiapkan `batako_online.sql`

4. Akses aplikasi melalui browser:

* Halaman pelanggan: `http://localhost/batako-online/index.php`
* Halaman admin: `http://localhost/batako-online/admin/index.php`

## Catatan

* Default login admin:

  * Username: `admin`
  * Password: `tito`
* Password menggunakan MD5 (untuk produksi sebaiknya gunakan `password_hash()` dan `password_verify()`).

## Pengembangan Selanjutnya

* Tambahkan fitur pencarian dan filter pada dashboard admin.
* Tambahkan validasi ganda untuk email/no HP.
* Kirim email konfirmasi pesanan menggunakan SMTP.
* Fitur upload bukti pembayaran.
* Buat QR code/cetak bukti unik untuk pelanggan.

app screnshoot
menampilkan halaman pemesanan batako
![alt text](<Screenshot 2025-06-28 190405-2.png>)

menampilkan halaman login
![alt text](<Screenshot 2025-06-28 190418-4.png>)

daftar pemesan batako
![alt text](<Screenshot 2025-06-28 190445.png>)

Form pemesanan batako
![alt text](<Screenshot 2025-06-28 190405-3.png>)

Laporan jumlah pesanan perbulan
![alt text](<Screenshot 2025-06-28 190518.png>)

Laporaan lengkap data pemesanan
![alt text](<Screenshot 2025-06-28 190542.png>)

> Dikembangkan untuk UAS Teknologi Web Genap 2025
