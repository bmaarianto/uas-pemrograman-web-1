# UAS MEPET - Aplikasi Manajemen Produk PHP

**Dokumentasi Lengkap - Sistem Informasi Manajemen Produk**

## 📋 Daftar Isi
1. [Deskripsi Aplikasi](#deskripsi-aplikasi)
2. [Fitur Utama](#fitur-utama)
3. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
4. [Struktur Folder](#struktur-folder)
5. [Panduan Instalasi](#panduan-instalasi)
6. [Panduan Penggunaan](#panduan-penggunaan)
7. [Dokumentasi Video](#dokumentasi-video)
8. [Dokumentasi PDF](#dokumentasi-pdf)

---

## 📱 Deskripsi Aplikasi

**UAS MEPET** adalah aplikasi web berbasis PHP untuk manajemen produk dengan sistem autentikasi pengguna berjenjang (Role-Based Access Control). Aplikasi ini dirancang dengan arsitektur MVC sederhana namun lengkap, menggunakan front controller pattern untuk routing yang fleksibel dan responsive UI dengan Bootstrap.

### Tujuan Aplikasi
- Menyediakan sistem login aman dengan validasi kredensial
- Memungkinkan admin mengelola data produk (Create, Read, Update, Delete)
- Memberikan akses user biasa untuk melihat daftar produk
- Menyediakan fitur pencarian dan pagination untuk kemudahan navigasi

---

## ✨ Fitur Utama

### 1. **Sistem Autentikasi & Otorisasi**
   - Login dengan username dan password
   - Dua level user: **Admin** dan **User**
   - Session management yang aman
   - Logout functionality

### 2. **Manajemen Produk (Admin Only)**
   - ✅ **CREATE** - Tambah produk baru
   - ✅ **READ** - Tampilkan daftar produk dengan pagination
   - ✅ **UPDATE** - Edit produk yang sudah ada
   - ✅ **DELETE** - Hapus produk
   - Validasi form untuk mencegah data kosong

### 3. **Fitur Pencarian & Filter**
   - Search produk berdasarkan nama atau deskripsi
   - Pagination dengan 5 item per halaman
   - Live filtering tanpa refresh halaman

### 4. **User Interface**
   - Responsive design (mobile-first)
   - Bootstrap CSS framework
   - Navigation header dan footer
   - Alert messages untuk feedback pengguna

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|-----------|
| Backend | PHP 7.4+ |
| Database | MySQL/MariaDB |
| Frontend | HTML5, Bootstrap 5 |
| Server | Apache (dengan `.htaccess`) |
| Pattern | MVC (Model-View-Controller) |

### Library & Framework
- **Bootstrap 5** - Styling responsif
- **PDO (PHP Data Objects)** - Database abstraction
- **Native PHP Sessions** - Session management

---

## 📁 Struktur Folder

```
uas_mepet/
├── index.php                 # Front controller & router utama
├── config.php               # Konfigurasi database
├── README.md                # Dokumentasi ini
│
├── app/                     # Folder Application Logic
│   ├── Auth.php            # Class untuk autentikasi & session
│   ├── Database.php        # Class untuk koneksi database (PDO)
│   └── ProductModel.php    # Class untuk CRUD produk
│
├── views/                   # Folder Template/View
│   ├── header.php          # Header template dengan navbar
│   ├── footer.php          # Footer template
│   ├── login.php           # Halaman login
│   ├── products_list.php   # Halaman daftar produk
│   └── products_form.php   # Halaman form tambah/edit produk
│
└── scripts/                 # Folder Scripts
    └── setup.php           # Script setup database awal
```

---

## 🚀 Panduan Instalasi

### Prasyarat
- XAMPP / LAMP Stack / Server PHP dengan MySQL
- PHP versi 7.4 atau lebih tinggi
- MySQL/MariaDB Server berjalan
- Apache dengan module `mod_rewrite` aktif

### Langkah Instalasi

#### 1. **Siapkan Folder Aplikasi**
```bash
# Copy folder uas_mepet ke htdocs
# Windows: C:\xampp\htdocs\uas_mepet
# Linux: /var/www/html/uas_mepet
```

#### 2. **Konfigurasi Database**
Edit file `config.php`:
```php
<?php
return [
    'db' => [
        'host' => '127.0.0.1',      // Host MySQL
        'dbname' => 'gatau_db',     // Nama database
        'user' => 'root',           // User MySQL
        'pass' => ''                // Password MySQL
    ]
];
```

#### 3. **Jalankan Setup Database**
Buka terminal dan jalankan:
```bash
cd C:\xampp\htdocs\uas_mepet
php scripts/setup.php
```

**Output jika berhasil:**
```
✓ Database setup berhasil!
✓ Tabel users dan products telah dibuat
✓ Data default sudah ditambahkan
```

#### 4. **Mulai Server**
```bash
# Buka XAMPP Control Panel
# Klik "Start" pada Apache dan MySQL
```

#### 5. **Akses Aplikasi**
```
http://localhost/uas_mepet/
```

---

## 👥 Akun Default

Setelah setup berhasil, dua akun default tersedia:

| Username | Password | Role | Fungsi |
|----------|----------|------|--------|
| admin | password | Admin | Akses penuh CRUD produk |
| user | password | User | Hanya bisa melihat produk |

---

## 📖 Panduan Penggunaan

### A. Halaman Login

**URL:** `http://localhost/uas_mepet/login`

**Proses:**
1. Masukkan username dan password
2. Klik tombol "Login"
3. Jika berhasil, akan redirect ke halaman produk
4. Jika gagal, muncul pesan error "Invalid credentials"

**Diagram Alur Login:**
```
┌─────────────────────────────────┐
│         UAS MEPET - LOGIN        │
├─────────────────────────────────┤
│                                 │
│  Username: [____________]       │
│  Password: [____________]       │
│                                 │
│       [LOGIN]                   │
│                                 │
│  Default: admin / password      │
│           user / password       │
└─────────────────────────────────┘
```

### B. Halaman Daftar Produk

**URL:** `http://localhost/uas_mepet/products`

**Fitur:**
- Tampilkan semua produk dalam tabel
- Kolom: ID, Nama, Deskripsi, Harga, Aksi
- Pencarian berdasarkan nama atau deskripsi
- Pagination (5 item per halaman)

**Tombol Aksi (Hanya untuk Admin):**
- 🔗 **Edit** - Ubah data produk
- 🗑️ **Delete** - Hapus produk
- ➕ **Tambah Produk** - Membuka form input baru

**Contoh Tampilan Tabel Produk:**
```
┌────┬──────────────┬─────────────────────┬─────────┬────────┐
│ ID │ Nama Produk  │ Deskripsi           │ Harga   │ Aksi   │
├────┼──────────────┼─────────────────────┼─────────┼────────┤
│ 1  │ Laptop Asus  │ Core i7, RAM 8GB    │ Rp 7JT  │ Ed Del │
│ 2  │ Mouse Log.   │ Wireless, DPI 1600  │ Rp 350K │ Ed Del │
│ 3  │ Keyboard RGB │ Mechanical, RGB     │ Rp 800K │ Ed Del │
└────┴──────────────┴─────────────────────┴─────────┴────────┘

Halaman 1 dari 3 [<< | 1 | 2 | 3 | >>]
```

### C. Pencarian Produk

**Fitur Search:**
1. Ketikkan kata kunci di kolom "Cari Produk"
2. Sistem akan menampilkan produk yang cocok dengan nama atau deskripsi
3. Hasil akan di-reset ketika field kosong

**Contoh Query:**
```
Cari: "laptop" 
Result: 1 produk ditemukan (Laptop Asus)

Cari: "keyboard"
Result: 1 produk ditemukan (Keyboard RGB)
```

### D. Menambah Produk (Admin Only)

**URL:** `http://localhost/uas_mepet/products/create`

**Form Input:**
```
┌─────────────────────────────────┐
│     TAMBAH PRODUK BARU          │
├─────────────────────────────────┤
│                                 │
│ Nama Produk: *                  │
│ [_________________________]      │
│                                 │
│ Deskripsi: *                    │
│ [_________________________]      │
│                                 │
│ Harga (Rp): *                   │
│ [_________________________]      │
│                                 │
│  [SIMPAN]  [BATAL]             │
│                                 │
└─────────────────────────────────┘
```

**Proses Penyimpanan:**
1. Isi semua field yang required (*)
2. Klik tombol "Simpan"
3. Sistem akan validasi input (tidak boleh kosong)
4. Data disimpan ke database
5. Redirect ke halaman daftar produk

### E. Mengedit Produk (Admin Only)

**URL:** `http://localhost/uas_mepet/products/edit/{id}`

**Proses:**
1. Klik tombol "Edit" pada produk yang ingin diubah
2. Form terisi otomatis dengan data lama
3. Ubah data yang diperlukan
4. Klik "Simpan"
5. Perubahan tersimpan dan redirect ke daftar

### F. Menghapus Produk (Admin Only)

**URL:** `http://localhost/uas_mepet/products/delete/{id}`

**Proses:**
1. Klik tombol "Delete" pada produk
2. Produk langsung dihapus dari database
3. Redirect ke halaman daftar produk

### G. Logout

**Proses:**
1. Klik menu "Logout" di navigation bar
2. Session dihancurkan
3. Redirect ke halaman login

---

## 🏗️ Arsitektur Teknis

### Model-View-Controller (MVC)

```
REQUEST (User Action)
   ↓
index.php (Front Controller & Router)
   ├── Parse URL Route
   ├── Check Authentication
   ├── Validate Authorization
   └── Load Appropriate Model/View
        ↓
   Model Layer:
   ├── app/Auth.php (Authentication)
   ├── app/Database.php (Database Connection)
   └── app/ProductModel.php (Business Logic)
        ↓
   View Layer:
   └── views/*.php (HTML Templates)
        ↓
   HTTP RESPONSE (Rendered HTML)
```

### Database Schema

#### Tabel `users`
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'user'
);
```

**Data Default:**
```sql
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$...', 'admin'),
('user', '$2y$10$...', 'user');
```

#### Tabel `products`
```sql
CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📹 Dokumentasi Video

Dokumentasi lengkap dalam format video (durasi max 10 menit) tersedia di:

### 📺 YouTube: UAS PEMROGRAMAN WEB 1 - Sistem Informasi Manajemen Produk

**[📹 Tonton Video Dokumentasi di YouTube](https://youtu.be/vvOTQpRw2WQ)**

---

## 📄 Dokumentasi PDF

Dokumentasi lengkap dalam format PDF dengan screenshot dan penjelasan detail tersedia dalam file:

**[📄 Dokumentasi PDF](https://drive.google.com/file/d/1pA5bvpT5kl4gANN31q1GSKZSa4sI5Fmn/view?usp=sharing)**

---

## 📊 Statistik Aplikasi

| Metrik | Nilai |
|--------|-------|
| Total Files | 11 |
| Lines of Code (LOC) | ~500 |
| Database Tables | 2 |
| User Roles | 2 (Admin, User) |
| Main Features | 6 |
| View Templates | 5 |
| Model Classes | 2 |
| CSS Framework | Bootstrap 5 |

---

## 🔒 Keamanan

### Implementasi Security
1. **Password Hashing** - `password_hash()` & `password_verify()`
2. **SQL Injection Prevention** - PDO prepared statements
3. **XSS Protection** - `htmlspecialchars()` pada output
4. **Session Management** - `session_regenerate_id()` setelah login
5. **Role-Based Access Control (RBAC)** - Check role sebelum operasi

### Code Examples

**✅ BENAR - Prepared Statement (SQL Injection Prevention)**
```php
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :u');
$stmt->execute(['u' => $username]);
```

**❌ SALAH - Direct Query (Vulnerable)**
```php
$sql = "SELECT * FROM users WHERE username = '$username'";
// SQL Injection Risk!
```

---

## 🐛 Troubleshooting & Solutions

### Masalah #1: "Database connection failed"
**Penyebab:**
- MySQL server tidak berjalan
- Credentials salah di config.php

**Solusi:**
1. Buka XAMPP Control Panel, klik "Start" MySQL
2. Verifikasi config.php credentials
3. Jalankan: `php scripts/setup.php`

### Masalah #2: "Invalid credentials"
**Penyebab:**
- Username/password salah
- Setup database belum dijalankan

**Solusi:**
1. Default: admin / password
2. Pastikan setup.php sudah dijalankan

### Masalah #3: "Page not found (404)"
**Penyebab:**
- URL tidak sesuai atau .htaccess tidak aktif

**Solusi:**
1. Verifikasi folder path
2. Enable mod_rewrite di Apache
3. Restart Apache

### Masalah #4: "Access Denied (403)"
**Penyebab:**
- Hanya admin yang bisa edit/delete

**Solusi:**
1. Login dengan akun admin
2. Verifikasi role di database

---

## 💡 Tips & Best Practices

### Performance Optimization
- Gunakan indexing pada kolom yang sering di-query
- Implement caching untuk data yang jarang berubah
- Compress images untuk faster loading

### Development Tips
- Selalu validate input dari user
- Gunakan prepared statements
- Log semua aktivitas penting
- Test dengan berbagai browser

### Security Checklist
- [ ] Enable SSL/HTTPS di production
- [ ] Change default credentials
- [ ] Disable error display di production
- [ ] Keep PHP/MySQL updated
- [ ] Setup firewall & WAF
- [ ] Regular security audit

---

## 📈 Project Statistics

```
Project: UAS MEPET
Type: Web Application (PHP)
Architecture: MVC
Status: ✅ Production Ready
Last Update: 8 January 2026

Code Metrics:
├── Total Files: 11
├── PHP Files: 8
├── View Files: 5
├── Total LOC: ~500

Database:
├── Tables: 2 (users, products)
└── Storage: <1MB
```

---

## 📝 Changelog & History

### Version 1.0 (Release - 8 Januari 2026)
- ✅ User authentication system
- ✅ Role-based access control
- ✅ Product CRUD operations
- ✅ Search & pagination functionality
- ✅ Responsive UI with Bootstrap 5
- ✅ Full documentation with Video & PDF

---

## 📞 Support & Bantuan

### Untuk Bantuan Lebih Lanjut:
1. Baca dokumentasi lengkap di README.md ini
2. Tonton video tutorial di YouTube
3. Review source code dengan komentar
4. Check section Troubleshooting
5. Konsultasi dengan developer

---

## 📄 Lisensi

Aplikasi ini dibuat untuk keperluan **UAS (Ujian Akhir Semester)**.

Penggunaan:
- ✅ Boleh dimodifikasi untuk keperluan belajar
- ✅ Boleh di-deploy ke production
- ✅ Boleh dikembangkan lebih lanjut
- ⚠️ Harap sertakan credit/attribution

---

**Last Updated:** 8 Januari 2026  
**Version:** 1.0  
**Status:** ✅ Production Ready  
**Documentation:** Lengkap dengan Video & PDF
