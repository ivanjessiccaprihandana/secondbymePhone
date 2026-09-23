# SecondByMePhone

Website katalog iPhone second dengan stok per varian, preorder HP, penjualan iPhone ke toko, serta dashboard admin.

## Menjalankan dengan Docker

### Persyaratan

- Git
- Docker Desktop dengan Docker Compose

Docker Desktop sudah menyertakan Docker Engine, CLI, dan Compose. PHP, Composer, Node.js, serta MySQL tidak perlu dipasang secara terpisah.

### Instalasi pertama

```bash
git clone https://github.com/ivanjessiccaprihandana/secondbymePhone.git
cd secondbymePhone
docker compose up --build -d
```

Build pertama membutuhkan waktu beberapa menit karena Docker mengunduh image dan memasang dependency. Setelah container sehat, buka:

- Website: http://localhost:8000
- Login admin: http://localhost:8000/admin/login

Login awal Docker lokal:

```text
Email: admin@secondbymephone.id
Password: AdminDocker123
```

Segera ganti password melalui menu **Keamanan Akun** di dashboard admin.

### Perintah penting

Melihat status container:

```bash
docker compose ps
```

Melihat log aplikasi:

```bash
docker compose logs -f app
```

Menjalankan test:

```bash
docker compose exec app php artisan test
```

Menghentikan container tanpa menghapus database:

```bash
docker compose down
```

Menjalankan kembali:

```bash
docker compose up -d
```

### Peringatan penghapusan data

Perintah berikut menghapus volume dan seluruh database Docker:

```bash
docker compose down -v
```

Jangan gunakan `-v` jika ingin mempertahankan produk, stok, admin, dan preorder.

### Mengubah port

Jika port 8000 atau 3307 sudah dipakai:

```powershell
$env:DOCKER_APP_PORT=8080
$env:DOCKER_DB_PORT=3308
docker compose up -d
```

## Catatan production

Konfigurasi Compose ini ditujukan untuk local development, demo, dan reviewer setelah clone repository. Jangan gunakan password, `APP_KEY`, atau `APP_DEBUG=true` dari Compose ini untuk hosting production.

Untuk hosting, gunakan `.env` production dengan `APP_DEBUG=false`, HTTPS, password database kuat, dan password admin yang berbeda.
