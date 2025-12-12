import './bootstrap';

window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const links = document.getElementById('navLinks');
    const buttons = document.getElementById('navButtons');

  if (window.scrollY > 50) {
    // di skrol
    navbar.classList.remove('bg-transparent');
    navbar.classList.add('bg-white', 'shadow-md');

    // Link navbar
    links.classList.remove('text-white');
    links.classList.add('text-black');

    // Tombol login/register
    buttons.querySelectorAll('a').forEach(btn => {
      btn.classList.remove('text-white', 'border-white');
      btn.classList.add('text-black', 'border-gray-400');
    });
  } else {
    // di atas 
    navbar.classList.remove('bg-white', 'shadow-md');
    navbar.classList.add('bg-transparent');

    // Link navbar
    links.classList.remove('text-black');
    links.classList.add('text-white');

    // Tombol login register
    buttons.querySelectorAll('a').forEach(btn => {
      btn.classList.remove('text-black', 'border-gray-400');
      btn.classList.add('text-white', 'border-white');
    });
  }
});

// Navbar mobilenya
const menuBtn = document.getElementById("menu-btn");
const mobileMenu = document.getElementById("mobileMenu");
menuBtn.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
});