# SIGMA API Documentation

## Base URL

```
http://localhost/sigma/index.php?url=api
```

## Overview

SIGMA API menggunakan arsitektur RESTful dengan format JSON untuk request dan response. API ini digunakan untuk operasi CRUD data dan integrasi dengan frontend JavaScript.

---

## Authentication

### Login

**Endpoint:** `POST /api/auth/login`

**Request Body:**

```json
{
  "email": "admin@sigma.com",
  "password": "admin123"
}
```

**Response Success (200):**

```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user_id": 1,
    "name": "Admin",
    "email": "admin@sigma.com",
    "role": "admin"
  }
}
```

**Response Error (401):**

```json
{
  "success": false,
  "message": "Email atau password salah"
}
```

---

### Register

**Endpoint:** `POST /api/auth/register`

**Request Body:**

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

**Response Success (201):**

```json
{
  "success": true,
  "message": "Registrasi berhasil"
}
```

---

## Education Module

### Get All Education Content

**Endpoint:** `GET /api/education`

**Response Success (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Bahaya Judi Online",
      "description": "Dampak negatif dari judi online...",
      "content": "Konten lengkap...",
      "image_url": "/sigma/public/uploads/education/image.jpg",
      "video_url": "https://youtube.com/watch?v=...",
      "created_at": "2026-01-08 10:00:00"
    }
  ]
}
```

---

### Get Single Education

**Endpoint:** `GET /api/education/:id`

**Parameters:**

- `id` (integer) - Education ID

**Response Success (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Bahaya Judi Online",
    "description": "Dampak negatif dari judi online...",
    "content": "Konten lengkap...",
    "image_url": "/sigma/public/uploads/education/image.jpg",
    "video_url": "https://youtube.com/watch?v=...",
    "created_at": "2026-01-08 10:00:00"
  }
}
```

---

### Create Education

**Endpoint:** `POST /api/education`

**Headers:**

- `Content-Type: multipart/form-data`

**Request Body (Form Data):**

- `title` (string, required)
- `description` (string, required)
- `content` (text, required)
- `image` (file, optional) - JPG, PNG, max 5MB
- `video_url` (string, optional)

**Response Success (201):**

```json
{
  "success": true,
  "message": "Konten edukasi berhasil ditambahkan",
  "data": {
    "id": 5
  }
}
```

---

### Update Education

**Endpoint:** `POST /api/education/:id`

**Headers:**

- `Content-Type: multipart/form-data`

**Request Body (Form Data):**

- Same as Create Education

**Response Success (200):**

```json
{
  "success": true,
  "message": "Konten edukasi berhasil diupdate"
}
```

---

### Delete Education

**Endpoint:** `DELETE /api/education/:id`

**Response Success (200):**

```json
{
  "success": true,
  "message": "Konten edukasi berhasil dihapus"
}
```

---

## Respondent Module

### Get All Respondents

**Endpoint:** `GET /api/respondent`

**Response Success (200):**

```json
{
  "success": true,
  "data": [
    {
      "user_id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "total_assessments": 5,
      "last_assessment": "2026-01-08 14:30:00",
      "last_score": 25,
      "last_category": "Sedang"
    }
  ]
}
```

---

### Get Respondent Detail

**Endpoint:** `GET /api/respondent/:id`

**Parameters:**

- `id` (integer) - User ID

**Response Success (200):**

```json
{
  "success": true,
  "data": {
    "user": {
      "user_id": 2,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "assessments": [
      {
        "id": 10,
        "group_name": "Mahasiswa 2024",
        "score": 25,
        "category": "Sedang",
        "created_at": "2026-01-08 14:30:00",
        "answers": [
          {
            "question": "Apakah Anda sering bermain judi online?",
            "answer": "Kadang-kadang",
            "score": 2
          }
        ]
      }
    ]
  }
}
```

---

## Assessment Groups Module

### Get All Assessment Groups

**Endpoint:** `GET /api/assessment-groups`

**Query Parameters:**

- `page` (integer, optional) - Page number (default: 1)
- `limit` (integer, optional) - Items per page (default: 10)
- `search` (string, optional) - Search by name

**Response Success (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Mahasiswa 2024",
      "description": "Grup untuk mahasiswa tahun 2024",
      "created_at": "2026-01-01 10:00:00"
    }
  ],
  "pagination": {
    "total": 25,
    "page": 1,
    "limit": 10,
    "total_pages": 3
  }
}
```

---

### Get Assessment Group Detail

**Endpoint:** `GET /api/assessment-groups/:id`

**Response Success (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Mahasiswa 2024",
    "description": "Grup untuk mahasiswa tahun 2024",
    "created_at": "2026-01-01 10:00:00"
  }
}
```

---

### Create Assessment Group

**Endpoint:** `POST /api/assessment-groups`

**Request Body:**

```json
{
  "name": "Mahasiswa 2025",
  "description": "Grup untuk mahasiswa tahun 2025"
}
```

**Response Success (201):**

```json
{
  "success": true,
  "message": "Grup assessment berhasil ditambahkan",
  "data": {
    "id": 5
  }
}
```

---

### Update Assessment Group

**Endpoint:** `POST /api/assessment-groups/:id`

**Request Body:**

```json
{
  "name": "Mahasiswa 2025 Updated",
  "description": "Deskripsi baru"
}
```

**Response Success (200):**

```json
{
  "success": true,
  "message": "Grup assessment berhasil diupdate"
}
```

---

### Delete Assessment Group

**Endpoint:** `DELETE /api/assessment-groups/:id`

**Response Success (200):**

```json
{
  "success": true,
  "message": "Grup assessment berhasil dihapus"
}
```

---

## Questions Module

### Get All Groups (Dropdown)

**Endpoint:** `GET /api/questions/groups`

**Response Success (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Mahasiswa 2024"
    }
  ]
}
```

---

### Get All Questions

**Endpoint:** `GET /api/questions`

**Query Parameters:**

- `page` (integer, optional) - Page number (default: 1)
- `limit` (integer, optional) - Items per page (default: 10)
- `group_id` (integer, optional) - Filter by group

**Response Success (200):**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "group_id": 1,
      "group_name": "Mahasiswa 2024",
      "question_text": "Apakah Anda sering bermain judi online?",
      "option_1": "Tidak Pernah",
      "option_2": "Jarang",
      "option_3": "Kadang-kadang",
      "option_4": "Sering",
      "created_at": "2026-01-01 10:00:00"
    }
  ],
  "pagination": {
    "total": 50,
    "page": 1,
    "limit": 10,
    "total_pages": 5
  }
}
```

---

### Get Question Detail

**Endpoint:** `GET /api/questions/:id`

**Response Success (200):**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "group_id": 1,
    "group_name": "Mahasiswa 2024",
    "question_text": "Apakah Anda sering bermain judi online?",
    "option_1": "Tidak Pernah",
    "option_2": "Jarang",
    "option_3": "Kadang-kadang",
    "option_4": "Sering",
    "created_at": "2026-01-01 10:00:00"
  }
}
```

---

### Create Question

**Endpoint:** `POST /api/questions`

**Request Body:**

```json
{
  "group_id": 1,
  "question_text": "Pertanyaan baru?",
  "option_1": "Opsi 1",
  "option_2": "Opsi 2",
  "option_3": "Opsi 3",
  "option_4": "Opsi 4"
}
```

**Response Success (201):**

```json
{
  "success": true,
  "message": "Soal berhasil ditambahkan",
  "data": {
    "id": 15
  }
}
```

---

### Update Question

**Endpoint:** `POST /api/questions/:id`

**Request Body:**

```json
{
  "group_id": 1,
  "question_text": "Pertanyaan diupdate?",
  "option_1": "Opsi 1 baru",
  "option_2": "Opsi 2 baru",
  "option_3": "Opsi 3 baru",
  "option_4": "Opsi 4 baru"
}
```

**Response Success (200):**

```json
{
  "success": true,
  "message": "Soal berhasil diupdate"
}
```

---

### Delete Question

**Endpoint:** `DELETE /api/questions/:id`

**Response Success (200):**

```json
{
  "success": true,
  "message": "Soal berhasil dihapus"
}
```

---

## Profile Module

### Get Current User Profile

**Endpoint:** `GET /api/profile`

**Response Success (200):**

```json
{
  "success": true,
  "data": {
    "user_id": 2,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "user",
    "created_at": "2026-01-01 10:00:00"
  }
}
```

---

### Update Profile

**Endpoint:** `POST /api/profile/update`

**Request Body:**

```json
{
  "name": "John Doe Updated",
  "email": "john.new@example.com"
}
```

**Response Success (200):**

```json
{
  "success": true,
  "message": "Profile berhasil diupdate"
}
```

---

### Change Password

**Endpoint:** `POST /api/profile/change-password`

**Request Body:**

```json
{
  "current_password": "oldpassword",
  "new_password": "newpassword123",
  "confirm_password": "newpassword123"
}
```

**Response Success (200):**

```json
{
  "success": true,
  "message": "Password berhasil diubah"
}
```

---

## Error Response Format

Semua error response menggunakan format standar:

```json
{
  "success": false,
  "message": "Error message description"
}
```

### Common HTTP Status Codes

- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `500` - Internal Server Error

---

## Usage Example (JavaScript)

### Using Fetch API

```javascript
// GET Request
async function getEducationList() {
  try {
    const response = await fetch(
      "http://localhost/sigma/index.php?url=api/education"
    );
    const data = await response.json();

    if (data.success) {
      console.log(data.data);
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// POST Request
async function createEducation(formData) {
  try {
    const response = await fetch(
      "http://localhost/sigma/index.php?url=api/education",
      {
        method: "POST",
        body: formData, // FormData untuk upload file
      }
    );

    const data = await response.json();

    if (data.success) {
      alert(data.message);
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// DELETE Request
async function deleteEducation(id) {
  try {
    const response = await fetch(
      `http://localhost/sigma/index.php?url=api/education/${id}`,
      {
        method: "DELETE",
      }
    );

    const data = await response.json();

    if (data.success) {
      alert(data.message);
    }
  } catch (error) {
    console.error("Error:", error);
  }
}
```

---

## Notes

1. **Authentication:** Saat ini API menggunakan PHP Session untuk authentication. Pastikan session tetap aktif saat mengakses API.

2. **CORS:** API ini tidak menggunakan CORS header, pastikan frontend dan backend berada di domain yang sama.

3. **File Upload:** Untuk upload file, gunakan `FormData` dan set Content-Type header ke `multipart/form-data`.

4. **Pagination:** Semua list endpoint mendukung pagination dengan parameter `page` dan `limit`.

5. **Error Handling:** Selalu cek property `success` pada response untuk mengetahui status request.

---

## Contact

Untuk pertanyaan atau issue terkait API, silakan hubungi:

- **Developer:** Doni Setiawan Wahyono
- **Email:** donisetiawanwahyono@gmail.com
- **
