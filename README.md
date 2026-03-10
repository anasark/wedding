# Wedding Invitation

Frontend undangan ini dibuat dengan Vue 3 + Vite. RSVP dan Buku Tamu sekarang bisa berjalan dalam dua mode:

- Tanpa backend: data disimpan di browser lokal lewat `localStorage`
- Dengan backend PHP: data dikirim ke API terpisah

## Frontend Lokal

1. Salin `.env.example` menjadi `.env` jika ingin mengarah ke backend PHP lokal.
2. Jalankan `npm install` jika dependency belum ada.
3. Jalankan `npm run dev`.

Jika `VITE_API_BASE_URL` tidak diisi, form akan fallback ke penyimpanan lokal browser.

## Backend PHP + MySQL

Backend terpisah ada di `backend-php/README.md`.

Untuk menjalankan lokal dengan Docker:

1. Buka folder `backend-php`
2. Jalankan `docker compose up --build`
3. API akan tersedia di `http://localhost:8080/api`

Frontend akan memakai backend itu jika `VITE_API_BASE_URL=http://localhost:8080/api`.
