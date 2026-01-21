// Initialize AOS
AOS.init({
   duration: 1000,
   once: true,
   offset: 100
});

// Initialize Swiper for Testimonials
const testimonialSwiper = new Swiper('.testimonialSwiper', {
   slidesPerView: 1,
   spaceBetween: 30,
   autoplay: {
      delay: 5000,
      disableOnInteraction: false,
   },
   pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   breakpoints: {
      // Mobile (less than 576px) - 1 item per slide
      0: {
         slidesPerView: 1,
         spaceBetween: 20,
      },
      // Tablet (576px and up) - 2 items per slide
      576: {
         slidesPerView: 2,
         spaceBetween: 25,
      },
      // Desktop (992px and up) - 3 items per slide
      992: {
         slidesPerView: 3,
         spaceBetween: 30,
      },
   },
   loop: false,
   grabCursor: true,
   effect: 'slide',
});

// Initialize Swiper for Promo
const promoSwiper = new Swiper('.promoSwiper', {
   slidesPerView: 2,
   spaceBetween: 30,
   autoplay: {
      delay: 4000,
      disableOnInteraction: false,
   },
   pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   breakpoints: {
      // Show 2 slides on all devices as requested
      0: {
         slidesPerView: 2,
         spaceBetween: 15,
      },
      768: {
         slidesPerView: 2,
         spaceBetween: 30,
      },
   },
   loop: true,
   grabCursor: true,
});

// Initialize Swiper for Paket Usaha
const paketSwiper = new Swiper('.paketSwiper', {
   slidesPerView: 3,
   spaceBetween: 30,
   autoplay: {
      delay: 5000,
      disableOnInteraction: false,
   },
   pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   breakpoints: {
      // Mobile (<= 576px) - 1 item per slide for a cleaner mobile view
      0: {
         slidesPerView: 1,
         spaceBetween: 12,
      },
      // Small tablets (>= 576px) - 2 items
      576: {
         slidesPerView: 2,
         spaceBetween: 15,
      },
      // Desktop (>= 992px) - 3 items per slide
      992: {
         slidesPerView: 3,
         spaceBetween: 30,
      },
   },
   loop: true,
   grabCursor: true,
});

// Initialize Swiper for Blog
const blogSwiper = new Swiper('.blogSwiper', {
   slidesPerView: 4,
   spaceBetween: 30,
   autoplay: {
      delay: 6000,
      disableOnInteraction: false,
   },
   pagination: {
      el: '.swiper-pagination',
      clickable: true,
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   breakpoints: {
      // Mobile (< 768px) - 2 items per slide as requested
      0: {
         slidesPerView: 2,
         spaceBetween: 15,
      },
      // Tablet (768px - 1199px) - 3 items per slide
      768: {
         slidesPerView: 3,
         spaceBetween: 25,
      },
      // Desktop (>= 1200px) - 4 items per slide
      1200: {
         slidesPerView: 4,
         spaceBetween: 30,
      },
   },
   loop: true,
   grabCursor: true,
});

// Initialize Swiper for Produk (responsive - mobile carousel)
const productSwiper = new Swiper('.product-swiper', {
   slidesPerView: 3,
   spaceBetween: 30,
   pagination: {
      el: '.product-swiper-pagination',
      clickable: true,
      dynamicBullets: true,
   },
   autoplay: {
      delay: 5000,
      // disableOnInteraction: false,
   },
   navigation: {
      nextEl: '.product-swiper-next',
      prevEl: '.product-swiper-prev',
   },
   breakpoints: {
      0: {
         slidesPerView: 1,
         spaceBetween: 15,
      },
      576: {
         slidesPerView: 2,
         spaceBetween: 20,
      },
      992: {
         slidesPerView: 3,
         spaceBetween: 30,
      },
   },
   loop: false,
   grabCursor: true,
   watchOverflow: true,
});

// Counter Animation
function animateCounter() {
   const counters = document.querySelectorAll('.counter');
   counters.forEach(counter => {
      const target = parseInt(counter.getAttribute('data-target'));
      const duration = 5000;
      const increment = target / (duration / 16);
      let current = 0;

      const updateCounter = () => {
         current += increment;
         if (current < target) {
            counter.textContent = Math.floor(current) + '+';
            requestAnimationFrame(updateCounter);
         } else {
            counter.textContent = target + '+';
         }
      };
      updateCounter();
   });
}

// Trigger counter when section is in view
const statsSection = document.querySelector('.stats-section');
const observer = new IntersectionObserver((entries) => {
   entries.forEach(entry => {
      if (entry.isIntersecting) {
         animateCounter();
         observer.unobserve(entry.target);
      }
   });
});

if (statsSection) {
   observer.observe(statsSection);
}


// Countdown Timer (dummy)
function startCountdown() {
   const daysElement = document.getElementById('days-promo');
   if (!daysElement) return;

   let days = $('#days-promo').data('days') || 0;
   let hours = $('#hours-promo').data('hours') || 0;
   let minutes = $('#mins-promo').data('mins') || 0;
   let seconds = $('#secs-promo').data('secs') || 0;

   const timerInterval = setInterval(() => {
      seconds--;
      if (seconds < 0) {
         seconds = 59;
         minutes--;
      }
      if (minutes < 0) {
         minutes = 59;
         hours--;
      }
      if (hours < 0) {
         hours = 23;
         days--;
      }

      if (days < 0) {
         clearInterval(timerInterval);

         // Ganti teks timer
         document.querySelector('.timer-display').textContent = 'PROMO TELAH BERAKHIR';

         // Hapus teks "Promo Berakhir Dalam:"
         const label = document.querySelector('.card-body p');
         if (label) label.remove();

         // Ganti background card
         const card = document.querySelector('.card');
         card.style.background = '#7f1d1d';

         return;
      }

      // Update all timers
      document.getElementById('days-promo').textContent = String(days).padStart(2, '0');
      document.getElementById('hours-promo').textContent = String(hours).padStart(2, '0');
      document.getElementById('mins-promo').textContent = String(minutes).padStart(2, '0');
      document.getElementById('secs-promo').textContent = String(seconds).padStart(2, '0');
   }, 1000);
}

startCountdown();

// WhatsApp Function
function openWhatsApp() {
   const phone = '6281234567890'; // Ganti dengan nomor WA Anda
   const message = encodeURIComponent('Halo, saya tertarik dengan paket usaha laundry. Mohon info lebih lanjut.');
   window.open(`https://wa.me/${phone}?text=${message}`, '_blank');
}

// Smooth Scroll
function scrollToSection(sectionId) {
   const section = document.getElementById(sectionId);
   section.scrollIntoView({ behavior: 'smooth' });
}


// Smooth scroll for nav links and Active State
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
   anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');

      // If href is just "#", do nothing
      if (targetId === '#') return;

      const target = document.querySelector(targetId);
      if (target) {
         // Update active state immediately on click
         document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.classList.remove('active');
         });
         this.classList.add('active');

         target.scrollIntoView({
            behavior: 'smooth', block: 'start'
         });
      }
   });
});

// Scrollspy to update active state on scroll
window.addEventListener('scroll', () => {
   let current = '';
   const sections = document.querySelectorAll('section');

   sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (pageYOffset >= (sectionTop - 150)) { // Offset for navbar height
         current = section.getAttribute('id');
      }
   });

   if (current) {
      document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
         link.classList.remove('active');
         if (link.getAttribute('href').includes('#' + current)) {
            link.classList.add('active');
         }
      });
   }
});

// Back to Top Button
const backToTopButton = document.getElementById('backToTop');

window.addEventListener('scroll', () => {
   if (window.pageYOffset > 300) {
      backToTopButton.classList.add('show');
   } else {
      backToTopButton.classList.remove('show');
   }
});

// Product Filtering
document.addEventListener('DOMContentLoaded', () => {
   const filterButtons = document.querySelectorAll('.btn-filter');
   const productItems = document.querySelectorAll('.product-item');

   if (window.location.hash === '#produk') {
      const section = document.getElementById('produk');
      if (section) section.scrollIntoView({ behavior: 'smooth' });
   }

   filterButtons.forEach(button => {
      button.addEventListener('click', () => {
         // Remove active class from all buttons
         filterButtons.forEach(btn => btn.classList.remove('active'));
         // Add active class to clicked button
         button.classList.add('active');

         const filter = button.getAttribute('data-filter');

         productItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
               // clear inline display to use default (allow Swiper to compute layout)
               item.style.display = '';
            } else {
               item.style.display = 'none';
            }
         });

         // If Swiper is initialized, update it and reset to the first slide so there are no empty slides
         if (typeof productSwiper !== 'undefined' && productSwiper) {
            productSwiper.update();
            productSwiper.slideTo(0);
         }

         // Refresh AOS in case filtered items need animation re-run
         if (typeof AOS !== 'undefined' && AOS.refresh) {
            AOS.refresh();
         }
      });
   });
});

backToTopButton.addEventListener('click', () => {
   window.scrollTo({
      top: 0,
      behavior: 'smooth'
   });
});

// Simple lightbox for promo images
(function () {
   const thumbs = document.querySelectorAll('.promo-thumb');
   const lightbox = document.getElementById('promoLightbox');
   if (!lightbox || !thumbs.length) return;

   const overlay = lightbox.querySelector('.lightbox-overlay');
   const img = lightbox.querySelector('.lightbox-img');
   const closeBtn = lightbox.querySelector('.lightbox-close');

   function openLightbox(src, alt) {
      img.src = src || '';
      img.alt = alt || '';
      lightbox.classList.add('show');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
   }

   function closeLightbox() {
      lightbox.classList.remove('show');
      lightbox.setAttribute('aria-hidden', 'true');
      img.src = '';
      document.body.style.overflow = '';
   }

   thumbs.forEach(t => {
      t.addEventListener('click', (e) => {
         const src = t.getAttribute('data-full') || t.src;
         openLightbox(src, t.alt || '');
      });
   });

   [overlay, closeBtn].forEach(el => el && el.addEventListener('click', closeLightbox));

   // Close on ESC
   document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeLightbox();
   });

   // Prevent clicks on image from closing
   lightbox.querySelector('.lightbox-content').addEventListener('click', (e) => {
      e.stopPropagation();
   });
})();
