const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobileMenu');

menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const links = document.getElementById('navLinks');
    const buttons = document.getElementById('navButtons');

    const navLinksToColor = document.querySelectorAll('#navButtons > a');

    if (window.scrollY > 50) {
        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');

        links.classList.remove('text-white');
        links.classList.add('text-black');

        navLinksToColor.forEach(btn => {
            btn.classList.remove('text-white', 'border-white');
            btn.classList.add('text-black', 'border-gray-400');
        });

    } else {
        // warna putuh
        navbar.classList.remove('bg-white', 'shadow-md');
        navbar.classList.add('bg-transparent');

        links.classList.remove('text-black');
        links.classList.add('text-white');

        navLinksToColor.forEach(btn => {
            btn.classList.remove('text-black', 'border-gray-400');
            btn.classList.add('text-white', 'border-white');
        });
    }
});

