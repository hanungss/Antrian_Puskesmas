# 🏥 Sistem Antrian Digital 

Sistem antrian berbasis web sederhana namun efektif yang dirancang untuk kebutuhan pendaftaran pasien di Puskesmas Tamansari. Sistem ini mendukung pembaruan nomor secara real-time, edukasi kesehatan melalui video, dan fitur panggilan suara otomatis (Text-to-Speech) menggunakan aset audio lokal.

## ✨ Fitur Utama

- **Display Antrian Real-time**: Dashboard akan memperbarui nomor antrian dan loket secara otomatis setiap detik tanpa refresh halaman.
- **Sistem Panggilan Suara**: Secara otomatis memanggil nomor antrian dalam bahasa Indonesia (contoh: "Nomor antrian, satu, satu, menuju loket, A").
- **Dashboard Edukasi**: Dilengkapi dengan pemutar video YouTube terintegrasi untuk memberikan edukasi kesehatan kepada pasien yang menunggu.
- **Panel Operator Dinamis**: Antarmuka kontrol bagi petugas untuk memanggil nomor berikutnya, mengulang panggilan, atau memanggil nomor sebelumnya dengan efek visual yang interaktif.
- **Tanpa Database**: Menggunakan sistem penyimpanan file datar (`antrian.txt`) yang ringan dan mudah dipindahkan antar server tanpa konfigurasi database yang rumit.

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP (untuk logika API dan manajemen file).
- **Frontend**: HTML5, Tailwind CSS 3.4 (untuk desain modern dan responsif).
- **JavaScript**: Fetch API (untuk komunikasi asinkron) dan Lucide Icons (untuk ikonografi).
- **Storage**: Plain Text / JSON untuk penyimpanan data antrian.

## 📂 Struktur Folder

```text
/
├── api.php             # Jembatan komunikasi antara operator dan display
├── index.php           # Dashboard utama untuk tampilan publik
├── loketA.php          # Panel kontrol untuk operator Loket A
├── antrian.txt         # File penyimpanan nomor antrian saat ini
├── antrian.json        # File cache untuk trigger panggilan suara otomatis
└── suara/              # Folder berisi aset audio (.mp3) untuk panggilan

## 🚀 Panduan Pemasangan dengan Docker

Dengan Docker, Anda tidak perlu menginstal XAMPP secara manual. Semua konfigurasi server sudah dibungkus dalam kontainer.

### 1. Persiapan
Pastikan PC tujuan sudah terinstal:
* **Docker Desktop** (untuk Windows/Mac)
* **Docker Engine & Compose** (untuk Linux)

### 2. Struktur File Konfigurasi
Pastikan folder proyek Anda memiliki file `Dockerfile` dan `docker-compose.yml