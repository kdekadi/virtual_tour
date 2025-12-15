window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const links = document.getElementById('navLinks');
    const buttons = document.getElementById('navButtons');

    //  link Login/Register
    const navLinksToColor = document.querySelectorAll('#navButtons > a');

    if (window.scrollY > 50) {
        // di scrlol

        navbar.classList.remove('bg-transparent');
        navbar.classList.add('bg-white', 'shadow-md');

        links.classList.remove('text-white');
        links.classList.add('text-black');

        navLinksToColor.forEach(btn => {
            // Hapus warna putih dan border putih dari posisi atas
            btn.classList.remove('text-white', 'border-white');
            
            // Tambahkan warna hitam dan border abu-abu
            // Catatan: Jika Register memiliki bg-green, jangan hapus bg-green-500!
            btn.classList.add('text-black', 'border-gray-400');
        });

    } else {
        // DI ATAS (UBAH KE PUTIH/WHITE)

        navbar.classList.remove('bg-white', 'shadow-md');
        navbar.classList.add('bg-transparent');

        links.classList.remove('text-black');
        links.classList.add('text-white');

        navLinksToColor.forEach(btn => {
            // Hapus warna hitam dan border abu-abu dari posisi scroll
            btn.classList.remove('text-black', 'border-gray-400');
            
            // Tambahkan warna putih dan border putih
            btn.classList.add('text-white', 'border-white');
        });
    }
});