# Laundry Landing Page - Struktur Project

## Struktur File & Folder

```
laundry/
├── index.html          # File HTML utama (Struktur & Layout)
├── css/
│   └── style.css       # Stylesheet utama & Custom Swiper styling
├── js/
│   └── main.js         # JavaScript utama (Swiper init, animations)
└── img/                # Folder untuk gambar & assets
```

## Deskripsi Fitur & Komponen Baru

### 1. Migrasi Swiper Slider
Beberapa section telah dimigrasikan dari grid statis/Bootstrap Carousel ke **Swiper JS** untuk fleksibilitas dan responsivitas yang lebih baik:
- **Promo Section**: Menampilkan 2 slide secara konsisten di semua perangkat.
- **Paket Usaha**: Menampilkan 3 item di desktop dan 2 item di mobile.
- **Blog Section**: Menampilkan 4 item di desktop dan 2 item di mobile.
- **Testimonial**: Slider testimonial dengan navigasi premium.

### 2. UI/UX Enhancements
- **Premium Navigation**: Tombol navigasi Swiper dengan efek *Glassmorphism* dan transisi ikon yang dinamis.
- **How It Works Layout**: Layout 4 kolom tetap (single row) di semua ukuran layar untuk menjaga alur visual.
- **Partner Auto-Scroll**: Track logo partner yang bergerak otomatis tanpa henti.
- **Responsive Grid**: Penyesuaian `col` pada Trust Badges dan Why Us untuk tampilan mobile yang lebih rapi (2-3 kolom).

### 3. Deskripsi File
- **index.html**: Menggunakan struktur Swiper untuk section kontemporer.
- **css/style.css**: Menyertakan variabel warna kustom, efek glassmorphism, dan optimalisasi mobile yang mendalam.
- **js/main.js**: Inisialisasi beberapa instance Swiper dengan pengaturan breakpoint yang spesifik.

## Teknologi & Library
- **HTML5 & CSS3** (Vanilla & Bootstrap 5)
- **Swiper JS**: Library slider modern untuk semua komponen interaktif.
- **AOS (Animate On Scroll)**: Untuk efek kemunculan elemen.
- **Bootstrap Icons**: Library ikon vektor.

## Customization

### Konfigurasi Slider
Untuk menyesuaikan jumlah item yang tampil, edit `breakpoints` pada inisialisasi Swiper di `js/main.js`.

### Mengubah Efek Glassmorphism
Cari class `.swiper-button-prev/next` di `style.css` untuk mengubah `backdrop-filter` atau `background` opacity.

### WhatsApp Integration
Ubah link/nomer di fungsi `openWhatsApp()` dalam `js/main.js`.

