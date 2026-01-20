@extends('landing-page.layout')

@section('content')
<div class="blog-page-header">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
               </ol>
            </nav>
            <h1 class="display-4 fw-bold mt-3">Hubungi Kami</h1>
            <p class="lead">Yuk, mampir ke toko kami! Kami siap membantu Anda memilih peralatan dan paket usaha laundry yang paling cocok. Jangan lupa buat janji dulu ya, supaya bisa kami layani lebih maksimal 😊</p>
         </div>
      </div>
   </div>
</div>

<section class="contact-section section-padding py-5">
   <div class="container">
      <div class="row">
         <!-- Contact Info -->
         <div class="col-lg-5">
            <div class="contact-unified-card">
               <h3 class="mb-4 fw-bold">Informasi Kontak</h3>
               
               <!-- Address -->
               <div class="contact-item-row d-flex align-items-center">
                  <div class="contact-icon-box">
                     <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div class="contact-details">
                     <h5>Alamat Kantor</h5>
                     <p>
                        Jl. Taman Alamanda Ⅲ No.32, Tropodo Wetan, Tropodo,
                        Kec. Waru, Kabupaten Sidoarjo Jawa Timur 61256
                     </p>
                  </div>
               </div>

               <!-- WhatsApp -->
               <div class="contact-item-row d-flex align-items-center">
                  <div class="contact-icon-box">
                     <i class="bi bi-whatsapp"></i>
                  </div>
                  <div class="contact-details w-100">
                     <h5>Kontak WhatsApp</h5>
                     <a href="#" onclick="openWhatsApp()" class="mb-3 btn w-100 btn-cta-nav text-white" title="Klik untuk menghubungi via WhatsApp">0819-0394-2454 (Admin 1)</a>
                     <a href="#" onclick="openWhatsApp()" class="mb-3 btn w-100 btn-cta-nav text-white" title="Klik untuk menghubungi via WhatsApp">0878-5699-7071 (Admin 2)</a>
                  </div>
               </div>
            </div>
         </div>

         <!-- Map -->
         <div class="col-lg-7">
            <div class="contact-map h-100">
               <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.8889452332655!2d112.7673413!3d-7.366343499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e5467d61d089%3A0xc28c4dfe2bbf9c04!2sOne%20Grosir%20Laundry%20(Alat%20Laundry%2C%20Teknisi%20Mesin%2C%20Perlengkapan%20Laundry)!5e0!3m2!1sen!2sid!4v1757576555328!5m2!1sen!2sid" 
                  class="contact-map-iframe" 
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade">
               </iframe>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
