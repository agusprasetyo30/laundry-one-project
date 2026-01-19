<!-- ===== PROMO SECTION ===== -->
<section id="promo" class="promo-section">
   <div class="container">
      <div class="section-title" data-aos="fade-up">
         <h2>Promo Spesial Bulan Ini</h2>
         <p>Dapatkan penawaran terbaik untuk memulai bisnis laundry Anda</p>
      </div>

      <div class="swiper promoSwiper" data-aos="fade-up">
         <div class="swiper-wrapper">
            <!-- Promo 1 -->
            <div class="swiper-slide">
               <div class="promo-card">
                  <div class="promo-image">
                     <img src="https://placehold.co/800x400/ff9800/ffffff?text=Promo+Paket+Pemula"
                        alt="Promo Paket Usaha" class="img-fluid promo-thumb" data-full="https://placehold.co/1600x800/ff9800/ffffff?text=Promo+Paket+Pemula">
                     <div class="promo-badge">HOT DEAL</div>
                  </div>
                  <div class="promo-content text-center">
                     <h3>Paket Usaha Pemula</h3>
                     <p class="promo-desc">Diskon 30% untuk pembelian paket usaha laundry pemula lengkap dengan
                        instalasi.</p>
                     <div class="promo-price mb-3">
                        <span class="old-price d-inline-block me-2">Rp 25.000.000</span>
                        <span class="new-price">Rp 17.500.000</span>
                     </div>
                     <button class="btn btn-sm btn-promo" onclick="openWhatsApp()">Ambil Promo</button>
                  </div>
               </div>
            </div>

            <!-- Promo 2 -->
            <div class="swiper-slide">
               <div class="promo-card">
                  <div class="promo-image">
                     <img src="https://placehold.co/800x400/0d6efd/ffffff?text=Bonus+Setrika+Uap" alt="Promo Bonus"
                        class="img-fluid promo-thumb" data-full="https://placehold.co/1600x800/0d6efd/ffffff?text=Bonus+Setrika+Uap">
                     <div class="promo-badge">LIMITED</div>
                  </div>
                  <div class="promo-content text-center">
                     <h3>Bonus Setrika Uap</h3>
                     <p class="promo-desc">Gratis 1 unit setrika uap boiler 10L untuk setiap pembelian Paket
                        Medium.</p>
                     <div class="promo-price mb-3">
                        <span class="text-success fw-bold fs-4">GRATIS BONUS</span>
                     </div>
                     <button class="btn btn-sm btn-promo" onclick="openWhatsApp()">Klaim Bonus</button>
                  </div>
               </div>
            </div>

            <!-- Promo 3 -->
            <div class="swiper-slide">
               <div class="promo-card">
                  <div class="promo-image">
                     <img src="https://placehold.co/800x400/20c997/ffffff?text=Gratis+Ongkir" alt="Promo Ongkir"
                        class="img-fluid promo-thumb" data-full="https://placehold.co/1600x800/20c997/ffffff?text=Gratis+Ongkir">
                     <div class="promo-badge">SPECIAL</div>
                  </div>
                  <div class="promo-content text-center">
                     <h3>Gratis Ongkir Jawa-Bali</h3>
                     <p class="promo-desc">Subsidi ongkos kirim hingga 100% untuk pengiriman paket usaha ke
                        seluruh Jawa & Bali.</p>
                     <div class="promo-price mb-3">
                        <span class="old-price d-inline-block me-2">Rp 2.000.000</span>
                        <span class="text-success fw-bold fs-4">GRATIS Ongkir</span>
                     </div>
                     <button class="btn btn-sm btn-promo" onclick="openWhatsApp()">Klaim Promo</button>
                  </div>
               </div>
            </div>

            <!-- Promo 4 -->
            <div class="swiper-slide">
               <div class="promo-card">
                  <div class="promo-image">
                     <img src="https://placehold.co/800x400/6610f2/ffffff?text=Diskon+Parfum" alt="Promo Parfum"
                        class="img-fluid promo-thumb" data-full="https://placehold.co/1600x800/6610f2/ffffff?text=Diskon+Parfum">
                     <div class="promo-badge">FLASH SALE</div>
                  </div>
                  <div class="promo-content text-center">
                     <h3>Paket Parfum Laundry</h3>
                     <p class="promo-desc">Diskon 50% untuk pembelian paket parfum laundry 5 Liter varian apa
                        saja.</p>
                     <div class="promo-price mb-3">
                        <span class="old-price d-inline-block me-2">Rp 250.000</span>
                        <span class="new-price">Rp 125.000</span>
                     </div>
                     <button class="btn btn-sm btn-promo" onclick="openWhatsApp()">Beli Sekarang</button>
                  </div>
               </div>
            </div>
         </div>

         <!-- Swiper Navigation -->
         <div class="swiper-button-prev"></div>
         <div class="swiper-button-next"></div>

         <!-- Swiper Pagination -->
         <div class="swiper-pagination"></div>
      </div>

   </div>
   <div class="countdown-timer">
      <p>Promo Berakhir Dalam:</p>
      <div class="timer-display">
         <span id="days1">05</span>:<span id="hours1">12</span>:<span id="mins1">34</span>:<span id="secs1">56</span>
      </div>
   </div>
</section>

<!-- Lightbox Modal for Promo Images -->
<div id="promoLightbox" class="lightbox" aria-hidden="true">
   <div class="lightbox-overlay" data-action="close"></div>
   <div class="lightbox-content" role="dialog" aria-modal="true" aria-label="Promo image preview">
      <button class="lightbox-close" aria-label="Tutup preview" data-action="close">×</button>
      <img src="" alt="Preview" class="lightbox-img">
   </div>
</div>
