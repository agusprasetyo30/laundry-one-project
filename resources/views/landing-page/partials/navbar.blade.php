<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg fixed-top" aria-label="Main navigation">
   <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}" aria-label="LaundryPro Home">
         <i class="bi bi-water"></i> LaundryPro
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
         aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         @php
            $isActiveBlogContact = false;
            $isActiveContact = false;
            
            if (request()->is('blog') || request()->is('blog/*')) {
               $isActiveBlogContact = true;
            }

            if (request()->is('hubungi-kami')) {
               $isActiveContact = true;
            }
         @endphp
         <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
               <a class="nav-link" href="{{ route('index') }}#beranda">Beranda</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('index') }}#tentang">Tentang Kami</a>
               </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('index') }}#paket">Paket Usaha</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('index') }}#produk">Produk</a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ $isActiveBlogContact ? 'active' : '' }}" href="{{ route('index') }}#blog">Blog & Tips</a>
            </li>

            <li class="nav-item">
               <a class="nav-link {{ $isActiveContact ? 'active' : '' }}" href="{{ route('hubungi-kami') }}">Hubungi Kami</a>
            </li>
            <li class="nav-item">
               <button class="btn btn-cta-nav" onclick="openWhatsApp()" aria-label="Konsultasi via WhatsApp">
                  <i class="bi bi-whatsapp"></i> Konsultasi WA
               </button>
            </li>
         </ul>
      </div>
   </div>
</nav>
