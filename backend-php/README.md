# Wedding PHP Backend

Backend ini berdiri sendiri untuk RSVP dan Buku Tamu. Lokal dijalankan pakai Docker, sedangkan saat deploy ke cPanel folder ini bisa dipisah ke domain atau subdomain lain.

## Stack

- PHP 8.3 + Apache
- MySQL 8.4
- Docker Compose

## Struktur

- `public/` dokumen root aplikasi PHP
- `public/api/rsvp.php` endpoint RSVP
- `public/api/guestbook.php` endpoint Buku Tamu
- `src/bootstrap.php` helper koneksi DB dan response JSON
- `initdb/01-schema.sql` schema tabel MySQL

## Menjalankan Lokal

1. Salin `.env.example` menjadi `.env` jika ingin mengganti port atau credential.
2. Dari folder `backend-php`, jalankan `docker compose up --build`.
3. API tersedia di `http://localhost:8080`.
4. MySQL tersedia di `127.0.0.1:3307`.

Jika MySQL pernah gagal start saat inisialisasi pertama, hapus volume data yang setengah jadi lalu jalankan ulang:

```bash
docker compose down -v
docker compose up --build
```

## Endpoint

### GET `/api/rsvp.php`

Mengambil daftar RSVP.

### POST `/api/rsvp.php`

Body JSON:

```json
{
  "name": "Anas",
  "attendance": "yes",
  "guests": 2
}
```

### GET `/api/guestbook.php`

Mengambil daftar ucapan.

### POST `/api/guestbook.php`

Body JSON:

```json
{
  "name": "Rizka",
  "message": "Semoga lancar sampai hari H"
}
```

## Deploy ke cPanel

1. Upload seluruh file backend ke server Anda (termasuk folder `src/`, `public/`, dan file `.env`).
2. Jika document root backend Anda tidak diarahkan ke `public/`, Anda bisa menambah file `.htaccess` di root (sejajar dengan `.env`) untuk routing masuk ke `public/`.
3. Buat database MySQL dan import `initdb/01-schema.sql` lewat phpMyAdmin atau menu cPanel MySQL Database.
4. Salin `.env.example` menjadi `.env` di direktori yang sama dengan folder `src/` Anda. Skrip PHP (`bootstrap.php`) sudah dikonfigurasi agar bisa membaca `.env` secara manual di cPanel.
5. Atur `FRONTEND_ORIGIN` di dalam `.env` ke domain frontend agar CORS mengizinkan request lintas domain.

## Catatan

- Endpoint ini memang terbuka untuk `GET` dan `POST`, jadi untuk produksi sebaiknya tambahkan rate limiting atau captcha.
- Saat ini frontend utama belum wajib memakai backend ini; integrasi bisa diarahkan ke domain backend lewat URL API.