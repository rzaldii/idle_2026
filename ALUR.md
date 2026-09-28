# Dokumentasi Alur Sistem Website IDLe (Informatics Dynamic Learning)

Dokumen ini menjelaskan alur operasional sistem kompetisi IDLe dari awal pendaftaran hingga tahap akhir (final), ditinjau dari dua sudut pandang: **Sisi Peserta** dan **Sisi Administrator (Ormawa/Panitia)**.

---

## Daftar Isi

1. [Arsitektur & Konsep Utama](#1-arsitektur--konsep-utama)
2. [Alur Sisi Peserta (User Flow)](#2-alur-sisi-peserta-user-flow)
3. [Alur Sisi Admin / Ormawa (Admin Flow)](#3-alur-sisi-admin--ormawa-admin-flow)
4. [Tabel Matriks Babak & Submission](#4-tabel-matriks-babak--submission)
5. [Mekanisme Teknis di Balik Layar](#5-mekanisme-teknis-di-balik-layar)
6. [Fitur Tambahan Administrator](#6-fitur-tambahan-administrator)

---

## 1. Arsitektur & Konsep Utama

Sistem IDLe mengelola perlombaan IT lintas ormawa Fakultas Ilmu Komputer Universitas Jember:

-   **Ormawa Penyelenggara**:
    -   **Himasif** (PPL, Smart City, Bisnis TIK)
    -   **Himatif** (UI/UX, Game Development, Animasi, IoT)
    -   **Hmif** (CPC, KTI)
    -   **Laos** (CTF)
-   **Tingkatan Babak (`babak`)**:
    -   `Babak 1`: Penyisihan 1 (Tahap pendaftaran & pengumpulan proposal/karya awal)
    -   `Babak 2`: Penyisihan 2 _(Opsional/Arsip)_
    -   `Babak 3`: Babak Final (Tahap presentasi / berkas akhir bagi tim yang lolos seleksi)
-   **Sistem Token Unik (`submissionid`)**:
    Setiap tim memiliki token rahasia yang di-generate menggunakan enkripsi MD5. Tautan submit hanya bisa diakses menggunakan token tersebut (`/submit/{token}`). Token ini **diperbarui secara otomatis** setiap kali tim dinyatakan lolos ke babak berikutnya untuk menjaga integritas tahap lomba.

---

## 2. Alur Sisi Peserta (User Flow)

```
[1. Pendaftaran Tim]
       ↓
[2. Menerima Email Pendaftaran + Link Submit 1]
       ↓
[3. Upload Berkas Submit 1 (Babak 1)]
       ↓
   (Menunggu Penjurian Penyisihan)
       ↓
[4. Menerima Email Pengumuman Final + Link Submit Final]
       ↓
[5. Upload Berkas Final (Babak 3)]
       ↓
[6. Presentasi / Penjurian Final & Pengumuman Juara]
```

### Langkah 1: Pendaftaran Tim

1. Peserta membuka halaman utama website dan memilih kategori lomba yang ingin diikuti (misal: `/kompetisi/uiux`).
2. Menekan tombol pendaftaran dan mengisi formulir:
    - Nama Tim.
    - Data Ketua Tim (NIM UNEJ, Nama, Email `@mail.unej.ac.id`, No. WhatsApp).
    - Data Anggota Tim (NIM, Nama, Email, No. HP).
3. Setelah klik **Submit Pendaftaran**, tim langsung tersimpan di sistem dengan status `babak = 1`.

### Langkah 2: Menerima Email Pendaftaran

1. Seluruh anggota tim menerima email otomatis bertajuk **"Pendaftaran IDLe"**.
2. Email memuat informasi registrasi, link grup WhatsApp / Discord resmi, dan tombol **"Submit"** berisi URL unik:
    ```
    https://[domain]/submit/{token_babak_1}
    ```

### Langkah 3: Pengumpulan Karya Penyisihan 1

1. Peserta membuka link dari email tersebut.
2. Karena tim berstatus `babak = 1`, sistem otomatis menampilkan halaman **Submit Tahap 1** (`pages/submission_1.blade.php`).
3. Peserta mengisi judul karya dan mengunggah dokumen (format `.pdf`, `.zip`, atau `.rar` maks 5 MB).
4. Setelah berhasil, karya tersimpan di server dan menunggu proses penilaian oleh panitia/juri.

### Langkah 4: Pengumuman Lolos Final

1. Jika tim dinilai layak dan dipilih oleh Admin untuk masuk final, seluruh anggota tim akan menerima email resmi bertajuk **"Pengumuman Final - [Nama Kategori]"**.
2. Email memuat ucapan selamat dan **Tautan Submit Final Baru**:
    ```
    https://[domain]/submit/{token_babak_3}
    ```
    _(Catatan: Tautan lama babak 1 otomatis tidak berlaku lagi)_.

### Langkah 5: Pengumpulan Berkas Final

1. Finalis membuka tautan submit final dari email pengumuman.
2. Sistem mendeteksi `babak = 3` dan menampilkan halaman **Submit Final** (`pages/submission_3.blade.php`).
3. Finalis mengunggah berkas presentasi / berkas revisi akhir (PPT/PDF/ZIP sesuai ketentuan kategori).

### Langkah 6: Presentasi & Penentuan Pemenang

1. Finalis mengikuti sesi presentasi atau tahap pengujian langsung bersama dewan juri.
2. Menunggu pengumuman pemenang resmi dari panitia.

---

## 3. Alur Sisi Admin / Ormawa (Admin Flow)

```
[1. Login Admin Ormawa]
       ↓
[2. Menu Kompetisi (Penyisihan 1) → Cek Berkas Masuk & Export Excel]
       ↓
[3. Menu Set Nilai (Penyisihan 1) → Input Nilai Juri]
       ↓
[4. Menu Kompetisi (Final) → Klik "+ Tambah Peserta Final"]
       ↓
   (Sistem Otomatis Mengirim Email Notifikasi Lolos Final ke Tim Terpilih)
       ↓
[5. Menu Kompetisi (Final) → Pantau Berkas Final yang Masuk]
       ↓
[6. Menu Set Nilai (Final) → Input Nilai Akhir & Penentuan Juara]
```

### Langkah 1: Login Administrator

1. Admin masuk melalui halaman login `/login`.
2. Akun admin terikat dengan ID Ormawa masing-masing (Himasif, Himatif, Hmif, Laos). Admin hanya dapat mengelola kategori lomba di bawah naungan ormawanya.

### Langkah 2: Monitoring Peserta & Berkas Penyisihan

1. Buka menu sidebar: **Kompetisi (Penyisihan 1) > [Nama Kategori]**.
2. Halaman menampilkan tabel data seluruh tim terdaftar:
    - Nomor, Nama Tim, Ketua Tim, Anggota.
    - Kolom **Submission**: Tombol download untuk mengunduh berkas yang diunggah peserta.
    - Tombol **Cetak XLS**: Untuk mengekspor daftar peserta ke file Excel.

### Langkah 3: Penilaian Babak Penyisihan (Set Nilai)

1. Buka submenu **Kompetisi (Penyisihan 1) > Set Nilai** (`/admin/penyisihan-1/set-nilai`).
2. Pilih tim yang akan dinilai.
3. Masukkan skor penilaian berdasarkan kriteria lomba, lalu simpan.
4. Dari rekapitulasi nilai ini, panitia menentukan tim mana saja yang berhak melaju ke Babak Final.

### Langkah 4: Meloloskan Tim ke Babak Final

1. Buka menu sidebar: **Kompetisi (Final) > [Nama Kategori]**.
2. Klik tombol biru **"+ Tambah Peserta Final"**.
3. Sistem menyajikan daftar tim dari babak penyisihan dalam bentuk dropdown/multi-select.
4. Pilih tim-tim yang dinyatakan lolos.
5. Klik tombol **Submit**:
    - Sistem otomatis memperbarui status tim menjadi `babak = 3`.
    - Sistem men-generate token unik baru untuk setiap tim.
    - Sistem **secara otomatis mengirimkan email pengumuman final** ke seluruh anggota tim yang terpilih.

### Langkah 5: Monitoring Berkas Final

1. Kembali ke menu **Kompetisi (Final) > [Nama Kategori]**.
2. Daftar finalis akan muncul di tabel.
3. Pada kolom **Submission**, admin dapat memantau dan mengunduh berkas presentasi/karya final yang diunggah peserta final.

### Langkah 6: Penilaian Final & Penentuan Juara

1. Buka submenu **Kompetisi (Final) > Set Nilai** (`/admin/final/set-nilai`).
2. Input nilai tahap final dari dewan juri.
3. Nilai final ini digunakan sebagai dasar penentuan Juara 1, 2, 3, dan Juara Favorit.

---

## 4. Tabel Matriks Babak & Submission

| Babak            | Status Kode (`babak`) | Tampilan Halaman Submit        | Lokasi Simpan File                 | Keterangan                                     |
| :--------------- | :-------------------: | :----------------------------- | :--------------------------------- | :--------------------------------------------- |
| **Penyisihan 1** |          `1`          | `pages/submission_1.blade.php` | `public_uploads/submission-1/`     | Pengumpulan proposal / karya tulis tahap awal  |
| **Penyisihan 2** |          `2`          | `pages/submission_2.blade.php` | `public_uploads/submission-2/`     | _(Opsional/khusus kategori tertentu jika ada)_ |
| **Final**        |          `3`          | `pages/submission_3.blade.php` | `public_uploads/submission-final/` | Pengumpulan slide presentasi / karya akhir     |

---

## 5. Mekanisme Teknis di Balik Layar

### A. Regenerasi Token Submission

Ketika status tim berpindah babak (misal dari penyisihan ke final), method `Tim::updateKompetisi($id, $babak)` dijalankan:

```php
'submissionid' => md5(date('Y-m-d h:M') . $id . $babak)
```

-   Hal ini mencegah peserta yang tidak lolos menggunakan link lama untuk mengunggah berkas babak lanjutan.
-   Link submit lama akan otomatis mengembalikan error 404 jika diakses setelah tim naik babak.

### B. Otomasi Pengiriman Email

-   Menggunakan library **Beautymail** dengan driver SMTP (`mail.idle2026.online`).
-   Alamat pengirim dinamis mengacu pada konfigurasi `config('mail.from.address')` (`idle2026@idle2026.online`).
-   Pengiriman email dilengkapi logging:
    -   Sukses: tercatat di `storage/logs/laravel-YYYY-MM-DD.log` dengan level `INFO`.
    -   Gagal: tercatat dengan level `ERROR` tanpa memutus/menggagalkan proses di halaman admin (aman dari crash).

---

## 6. Fitur Tambahan Administrator

1. **Broadcast Email (Menu `Email`)**:
    - Admin dapat mengirim email pengumuman massal atau khusus kepada peserta terpilih melalui menu `/admin/mail`.
2. **Fitur Tandai (Star)**:
    - Pada tabel peserta terdapat tombol bintang (tandai) untuk memberi penanda khusus pada tim tertentu (misal: tim bermasalah atau tim unggulan).
3. **Turunkan Tim (Rollback dari Final)**:
    - Jika terjadi salah input saat menambahkan peserta final, admin dapat menghapus tim dari daftar final. Sistem akan secara otomatis mengembalikan status tim ke babak penyisihan (`babak = 1`).
4. **Export Excel**:
    - Tersedia tombol cetak XLS di setiap tahapan lomba untuk mempermudah rekapitulasi data offline.
