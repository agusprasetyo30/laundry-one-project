// Initialize AOS
AOS.init({
   duration: 1000,
   once: true,
   offset: 100
});

// Counter Animation
function animateCounter() {
   const counters = document.querySelectorAll('.counter');
   counters.forEach(counter => {
      const target = parseInt(counter.getAttribute('data-target'));
      const duration = 2000;
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
observer.observe(statsSection);

// Countdown Timer (dummy)
function startCountdown() {
   let days = 5;
   let hours = 12;
   let minutes = 34;
   let seconds = 56;

   setInterval(() => {
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
         days = 5;
         hours = 12;
         minutes = 34;
         seconds = 56;
      }

      // Update all timers
      for (let i = 1; i <= 3; i++) {
         document.getElementById('days' + i).textContent = String(days).padStart(2, '0');
         document.getElementById('hours' + i).textContent = String(hours).padStart(2, '0');
         document.getElementById('mins' + i).textContent = String(minutes).padStart(2, '0');
         document.getElementById('secs' + i).textContent = String(seconds).padStart(2, '0');
      }
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

// Smooth scroll for nav links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
   anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
         target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
   });
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

backToTopButton.addEventListener('click', () => {
   window.scrollTo({
      top: 0,
      behavior: 'smooth'
   });
});
