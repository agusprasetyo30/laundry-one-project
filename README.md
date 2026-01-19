# Starter Pack Borwita Project
Project ini adalah project boilerplate yang digunakan untuk project baru pada borwita

## Configuration
- API Authentification, Validation & basic configuration
- Controller Configuration with Validation & exception handler
- View Blade Template with Stisla Template
- Request Response Configuration

## Features

### Pemisahan logic, semua tidak ditampung di controller
Hal ini digunakan untuk memudahkan pemahaman dan pemeliharaan kode, karena pada controller tidak terlalu panjang dan tidak terlalu kompleks

1. `app/Repositories`
   - Fungsi Utama
      Layer akses data (data source abstraction).
   - Tempat:
      - Query Eloquent / Query Builder
      - Ambil data dari DB
      - Bisa juga API / cache / file
   
   > Controller & Service tidak peduli data datang dari mana.

2. `app/Services`
   - Fungsi Utama
      - Business logic
      - Pemisahan logika bisnis
   - Tempat:
      - Rule diskon
      - Mapping payload
      - Orkestrasi banyak repository
      - Call API eksternal
      - Proses yang “bermakna bisnis”

   > Harus berdisi sendiri dan testable

3. `app/Traits`
   - Fungsi Utama
      - Helper lintas class
   - Tempat:
      - Helper method kecil
      - Logic yang dipakai lintas class
      - Tidak punya state penting

#### Penjelasan Singkat
- Controller → “apa yang terjadi”
- Service → “bagaimana bisnis bekerja”
- Repository → “data dari mana”
- Trait → “helper lintas class”

### Templating View
Untuk templating pada project ini menggunakan [Layout Blade Inheritance](https://laravel.com/docs/12.x/blade#layouts-using-template-inheritance) yang dimana dipisah antar bagian agar mudah untuk di maintenance. Pada project ini terdapat beberapa bagian yaitu : 
- breadcrumb
- navbar
- sidebar
- footer

Dan untuk parent layoutnya yaitu `app.blade.php` dan `custom.blade.php` menyesuaikan dengan kebutuhan sistem

### Blade Component Formatting
Konfigurasi ini digunakan untuk formatting pada blade yang nantinya digunakan untuk memformat data yang akan di tampilkan pada view. 
1. Konfigurasi Utama formatting blade (yang digunakan pada module view)
   ```php
   // Memanggil parent layout template
   @extends('layouts.app', ['title' => 'Title Name'])

   // Section title page
   @section('page-title', 'Title Page Name')

   // Section content utama
   @section('content')
   // ...
   @endsection
   ```

2. Komponen *stack* pada layout template yang dapat digunakan
   ```php
   // Stack CSS Library
   @push('css-library')
   // ...
   @endpush

   // Stack CSS jika menggunakan link
   @push('css-link')
   // ...
   @endpush

   // Stack CSS Custom
   @push('css-custom')
   //...
   @endpush

   // Stack JS Library
   @push('js-library')
   // ...
   @endpush

   // Stack JS Custom
   @push('js-custom')
   // ...
   @endpush

   // Stack JS Spesifik File
   @push('js-specific-file')
   // ...
   @endpush
   ```