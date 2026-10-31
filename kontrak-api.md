# Kontrak API Management Perpustakaan

## 1. Informasi API

**Nama API:** Management Perpus API  
**Base URL:** `http://127.0.0.1:8000`  
**Format:** JSON  
**Authentication:** Bearer Token menggunakan Laravel Sanctum

---

## 2. Authentication

API menggunakan Bearer Token untuk endpoint yang membutuhkan autentikasi.

Token diperoleh melalui endpoint:

`POST /api/login`

Token kemudian digunakan pada header:

```text
Authorization: Bearer {token}
```

Endpoint yang membutuhkan authentication akan mengembalikan status `401 Unauthorized` jika token tidak diberikan atau tidak valid.

---

# 3. Daftar Endpoint

| No | Method | Endpoint | Authentication | Keterangan |
|---|---|---|---|---|
| 1 | POST | `/api/register` | Tidak | Registrasi pengguna |
| 2 | POST | `/api/login` | Tidak | Login dan mendapatkan token |
| 3 | GET | `/api/user` | Ya | Mengambil data pengguna yang sedang login |
| 4 | GET | `/api/buku` | Tidak | Mengambil daftar buku |
| 5 | POST | `/api/buku` | Ya | Menambahkan buku |
| 6 | GET | `/api/buku/{id}` | Tidak | Mengambil detail buku |
| 7 | PUT | `/api/buku/{id}` | Ya | Mengubah data buku |
| 8 | DELETE | `/api/buku/{id}` | Ya | Menghapus buku |
| 9 | GET | `/api/siswa` | Tidak | Mengambil daftar siswa |
| 10 | GET | `/api/siswa/{id}` | Tidak | Mengambil detail siswa |
| 11 | POST | `/api/siswa` | Tidak | Menambahkan siswa |

---

# 4. Detail Endpoint

## 4.1 Register

**Method:** `POST`

**Endpoint:**

```text
/api/register
```

### Request Body

```json
{
    "name": "User API",
    "email": "userapi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### Validasi

- `name` wajib diisi.
- `email` wajib berupa email dan belum terdaftar.
- `password` wajib minimal 8 karakter.
- `password_confirmation` harus sama dengan password.

### Response Berhasil

**Status:** `201 Created`

```json
{
    "success": true,
    "message": "Registrasi berhasil",
    "data": {
        "user": {},
        "token": "token..."
    }
}
```

---

## 4.2 Login

**Method:** `POST`

**Endpoint:**

```text
/api/login
```

### Request Body

```json
{
    "email": "userapi@example.com",
    "password": "password123"
}
```

### Response Berhasil

**Status:** `200 OK`

```json
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": {},
        "token": "token..."
    }
}
```

Token dari response digunakan untuk mengakses endpoint yang membutuhkan authentication.

### Response Jika Login Gagal

**Status:** `401 Unauthorized`

```json
{
    "success": false,
    "message": "Email atau password salah"
}
```

---

## 4.3 Detail User

**Method:** `GET`

**Endpoint:**

```text
/api/user
```

### Authentication

Wajib menggunakan Bearer Token.

```text
Authorization: Bearer {token}
```

### Response Berhasil

**Status:** `200 OK`

```json
{
    "success": true,
    "message": "Data user berhasil diambil",
    "data": {}
}
```

### Jika Tidak Memiliki Token

**Status:** `401 Unauthorized`

---

## 4.4 Daftar Buku

**Method:** `GET`

**Endpoint:**

```text
/api/buku
```

### Authentication

Tidak diperlukan.

### Response Berhasil

**Status:** `200 OK`

```json
{
    "success": true,
    "message": "Data buku berhasil diambil",
    "data": []
}
```

Data buku dapat memiliki informasi relasi dengan author dan kategori.

---

## 4.5 Tambah Buku

**Method:** `POST`

**Endpoint:**

```text
/api/buku
```

### Authentication

Wajib menggunakan Bearer Token.

```text
Authorization: Bearer {token}
```

### Request Body

```json
{
    "judul_buku": "Buku API Testing",
    "author_id": 1,
    "kategori_id": 1,
    "stock": 10
}
```

### Validasi

- `judul_buku` wajib diisi.
- `author_id` wajib diisi dan harus terdapat pada tabel author.
- `kategori_id` wajib diisi dan harus terdapat pada tabel kategori.
- `stock` wajib berupa angka dan minimal `0`.

### Response Berhasil

**Status:** `201 Created`

```json
{
    "success": true,
    "message": "Buku berhasil ditambahkan",
    "data": {}
}
```

### Jika Tidak Memiliki Token

**Status:** `401 Unauthorized`

### Jika Data Tidak Valid

**Status:** `422 Unprocessable Content`

---

# 5. HTTP Status Code

| Status | Keterangan |
|---|---|
| 200 | Request berhasil |
| 201 | Data berhasil dibuat |
| 401 | Tidak terautentikasi / token tidak valid |
| 404 | Data tidak ditemukan |
| 422 | Data yang dikirim tidak memenuhi validasi |

---

# 6. Catatan Penggunaan

1. Jalankan server Laravel sebelum menggunakan API.

```bash
php artisan serve
```

2. Gunakan Base URL:

```text
http://127.0.0.1:8000
```

3. Lakukan register atau gunakan akun yang sudah tersedia.
4. Lakukan login untuk mendapatkan Bearer Token.
5. Masukkan token pada endpoint yang membutuhkan authentication.
6. Pengujian API dilakukan menggunakan Postman.