<!-- ===== BLOG/ARTIKEL SECTION ===== -->
<section id="blog" class="blog-section">
   <div class="container">
      <div class="section-title" data-aos="fade-up">
         <h2>Blog & Tips Laundry</h2>
         <p>Artikel dan tips terbaru seputar bisnis dan peralatan laundry</p>
      </div>
      <div class="swiper blogSwiper" data-aos="fade-up">
         <div class="swiper-wrapper">

            <!-- Article 1 -->
            <div class="swiper-slide">
               <article class="article-card">
                  <div class="article-image">
                     <img src="https://placehold.co/400x250/0d6efd/ffffff?text=Bisnis+Laundry"
                        alt="Tips Memulai Bisnis Laundry">
                  </div>
                  <div class="article-content">
                     <div class="article-meta">
                        <i class="bi bi-calendar3"></i>
                        <span>15 Des 2025</span>
                     </div>
                     <h3 class="article-title">Tips Memulai Bisnis Laundry dari Nol</h3>
                     <p class="article-excerpt">Panduan lengkap untuk memulai bisnis laundry yang menguntungkan
                        dengan
                        modal minim.</p>
                     <a href="{{ route('blog.show', 'tips-memulai-bisnis-laundry-dari-nol') }}" class="btn-read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                  </div>
               </article>
            </div>

            <!-- Article 2 -->
            <div class="swiper-slide">
               <article class="article-card">
                  <div class="article-image">
                     <img src="https://placehold.co/400x250/0d6efd/ffffff?text=Mesin+Cuci"
                        alt="Perawatan Mesin Laundry">
                  </div>
                  <div class="article-content">
                     <div class="article-meta">
                        <i class="bi bi-calendar3"></i>
                        <span>10 Des 2025</span>
                     </div>
                     <h3 class="article-title">Cara Merawat Mesin Cuci Agar Awet</h3>
                     <p class="article-excerpt">Tips perawatan mesin cuci industrial agar tetap optimal dan tahan
                        lama.
                     </p>
                     <a href="{{ route('blog.show', 'cara-merawat-mesin-cuci-agar-awet') }}" class="btn-read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                  </div>
               </article>
            </div>

            <!-- Article 3 -->
            <div class="swiper-slide">
               <article class="article-card">
                  <div class="article-image">
                     <img src="https://placehold.co/400x250/0d6efd/ffffff?text=Marketing" alt="Marketing Laundry">
                  </div>
                  <div class="article-content">
                     <div class="article-meta">
                        <i class="bi bi-calendar3"></i>
                        <span>5 Des 2025</span>
                     </div>
                     <h3 class="article-title">Strategi Marketing untuk Bisnis Laundry</h3>
                     <p class="article-excerpt">Cara efektif memasarkan jasa laundry di era digital untuk menarik
                        lebih
                        banyak pelanggan.</p>
                     <a href="{{ route('blog.show', 'strategi-marketing-untuk-bisnis-laundry') }}" class="btn-read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                  </div>
               </article>
            </div>

            <!-- Article 4 -->
            <div class="swiper-slide">
               <article class="article-card">
                  <div class="article-image">
                     <img src="https://placehold.co/400x250/0d6efd/ffffff?text=Peralatan" alt="Peralatan Laundry">
                  </div>
                  <div class="article-content">
                     <div class="article-meta">
                        <i class="bi bi-calendar3"></i>
                        <span>1 Des 2025</span>
                     </div>
                     <h3 class="article-title">Peralatan Wajib untuk Usaha Laundry</h3>
                     <p class="article-excerpt">Daftar lengkap peralatan yang harus Anda miliki untuk memulai usaha
                        laundry profesional.</p>
                     <a href="{{ route('blog.show', 'peralatan-wajib-untuk-usaha-laundry') }}" class="btn-read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                  </div>
               </article>
            </div>
         </div>
      </div>

      <!-- View All Button -->
      <div class="text-center mt-5" data-aos="fade-up">
         <a href="{{ route('blog.index') }}" class="btn btn-view-all">
            View All Posts <i class="bi bi-arrow-right-circle"></i>
         </a>
      </div>
   </div>
</section>
