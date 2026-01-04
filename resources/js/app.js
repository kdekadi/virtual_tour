document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobileMenu');
    const navbar = document.getElementById('navbar');
    const links = document.getElementById('navLinks');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    window.addEventListener('scroll', () => {
        const mainNavLinks = document.querySelectorAll('#navLinks a, #navButtons > a');
        const isMobile = window.innerWidth < 768;

        if (navbar && (isMobile || window.scrollY > 50)) {
            navbar.classList.add('bg-white', 'shadow-md');
            navbar.classList.remove('bg-transparent');
            
            if (links) links.classList.replace('text-white', 'text-black');

            mainNavLinks.forEach(link => {
                link.classList.add('text-black');
                link.classList.remove('text-white');
                if (link.parentElement.classList.contains('border')) {
                    link.parentElement.classList.replace('border-white', 'border-gray-400');
                }
            });
        } else if (navbar) {
            navbar.classList.add('bg-transparent');
            navbar.classList.remove('bg-white', 'shadow-md');
            
            if (links) links.classList.replace('text-black', 'text-white');

            mainNavLinks.forEach(link => {
                link.classList.add('text-white');
                link.classList.remove('text-black');
            });
        }

        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-link");
        let scrollPos = window.scrollY + 120;

        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute("id");

            if (scrollPos >= top && scrollPos < top + height) {
                navLinks.forEach(link => {
                    link.classList.remove("bg-green-400", "px-4", "py-2", "rounded-lg", "text-white");
                    if (link.dataset.link === id) {
                        link.classList.add("bg-green-400", "px-4", "py-2", "rounded-lg", "text-white");
                    }
                });
            }
        });
    });
});