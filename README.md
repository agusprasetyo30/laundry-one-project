# Laundry Landing Page - Struktur Project

## Struktur File & Folder

```
laundry/
├── index.html          # File HTML utama
├── css/
│   └── style.css       # Stylesheet utama (Bootstrap styling)
├── js/
│   └── main.js         # JavaScript utama (animations, interactions)
└── img/                # Folder untuk gambar (kosong, siap digunakan)
```

## Deskripsi File

### index.html
File HTML utama yang berisi:
- Semantic HTML5 structure
- SEO-optimized meta tags
- Integration dengan Bootstrap 5, AOS, dan custom CSS/JS
- Sections: Navbar, Hero, Stats, Why Us, Paket Usaha, Produk, Partner, Footer

### css/style.css
File CSS eksternal yang berisi:
- Custom CSS variables (color palette)
- Styling untuk semua section
- Responsive design dengan media queries
- Hover effects dan animations

### js/main.js
File JavaScript eksternal yang berisi:
- AOS initialization
- Counter animation untuk stats
- Countdown timer untuk promo
- WhatsApp integration function
- Smooth scroll functionality

### img/
Folder kosong untuk menyimpan gambar/asset yang akan digunakan

## Teknologi yang Digunakan

- **HTML5**: Semantic markup
- **CSS3**: Custom styling dengan Bootstrap 5
- **JavaScript ES6**: Modern JavaScript features
- **Bootstrap 5**: Framework CSS untuk responsiveness
- **AOS**: Animate On Scroll library
- **Google Fonts**: Poppins font family

## Cara Penggunaan

1. Buka file `index.html` di browser
2. Untuk development, gunakan Live Server atau HTTP server
3. Untuk production, pastikan semua file path sudah correct

## Customization

### Mengubah Nomor WhatsApp
Edit file `js/main.js`, cari fungsi `openWhatsApp()` dan ganti nomor telepon

### Mengubah Warna
Edit file `css/style.css`, ubah CSS variables di `:root`

### Menambah Gambar
Simpan gambar di folder `img/` dan update src di `index.html`
