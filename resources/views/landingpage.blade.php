<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Virtual Tour Bukit Trunyan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="icon" href="https://img.icons8.com/emoji/48/mountain.png" /> --}}
    <style>
      html {
        scroll-behavior: smooth;
      }
      /* Scrollbar  untuk komentar */
      #commentList::-webkit-scrollbar {
        width: 8px;
      }
      #commentList::-webkit-scrollbar-thumb {
        background-color: "#16a34a";
        border-radius: 9999px;
      }
    </style>
  </head>
  <body class="bg-light text-gray-800">
   
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out bg-transparent">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3">
        
        <!-- Logo -->
        <h1 class="text-xl font-bold text-primary">Bukit Trunyan</h1>

        <!-- Menu Desktop -->
        <ul id="navLinks" class="hidden md:flex space-x-6 text-white font-medium transition-colors duration-500">
        <li><a href="#home" class="hover:text-primary transition">Home</a></li>
        <li><a href="#sejarah" class="hover:text-primary transition">Sejarah</a></li>
        <li><a href="#informasi" class="hover:text-primary transition">Informasi</a></li>
        <li><a href="#galeri" class="hover:text-primary transition">Galeri</a></li>
        <li><a href="#komentar" class="hover:text-primary transition">Komentar</a></li>
        </ul>

        <!-- Login / Register / Dashboard -->
        @if (Route::has('login'))
        <div id="navButtons" class="hidden md:flex space-x-3 transition-colors duration-500">
            
            @auth
                <div x-data="{ open: false }" class="relative">
                    
                    <!-- Profil bulet -->
                   <button @click="open = !open" 
                        class="h-10 w-10 bg-black rounded-full flex items-center justify-center text-white font-bold text-xl hover:bg-black-100 transition focus:outline-none">        
                          {{-- ngambil huruf pertama dari username --}}
                           {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </button>
                
                    <!-- Menu Dropdown -->
                    <div x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-gray-100 rounded-md shadow-lg py-1 z-50 text-black"
                        style="display: none;">
                
                        {{-- <!-- Link Profil -->
                        <a href="{{ route('profil') }}" 
                          class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                            Profil
                        </a> --}}

                        @if (Auth::user()->role === 'admin')
                            <a href="/admin" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('profil') }}"  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Profil
                            </a>
                        @endif
                
                        <!-- Logout  -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type."submit" 
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            @else
                
                <a href="{{ route('login') }}"
                  class="px-4 py-2 border border-white text-white rounded-lg hover:bg-green-500 hover:border-green-200 transition">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                      class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Register
                    </a>
                @endif
            @endauth

        </div>
        @endif

        <!-- Mobile Button -->
        <button id="menu-btn" class="md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-inner">
        <ul class="flex flex-col text-center space-y-2 py-3 font-medium">
        <li><a href="#home" class="block py-2 hover:bg-green-100">Home</a></li>
        <li><a href="#sejarah" class="block py-2 hover:bg-green-100">Sejarah</a></li>
        <li><a href="#informasi" class="block py-2 hover:bg-green-100">Informasi</a></li>
        <li><a href="#galeri" class="block py-2 hover:bg-green-100">Galeri</a></li>
        <li><a href="#komentar" class="block py-2 hover:bg-green-100">Komentar</a></li>

        <!-- Login/Register di menu mobile -->
        @if (Route::has('login'))
            @auth
            <a href="{{ route('profil') }}" class="block py-2 hover:bg-green-100">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-center block py-2 hover:bg-green-100">
                    Logout
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block py-2 hover:bg-green-100">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block py-2 hover:bg-green-100">Register</a>
            @endif
            @endauth
        @endif
        </ul>
    </div>
    </nav>


    <!-- Hero -->
    <section
      id="home"
      class="h-screen bg-cover bg-center flex items-center justify-center relative"
      style="background-image: url('{{ asset('img/11.jpg') }}');"
    >
      <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/40"></div>
      <div class="relative text-center text-white px-4">
         @if ($heading_hero) 
        <h2 class="text-5xl font-extrabold mb-4">
            {!! $heading_hero->isi_content_web !!}
        </h2>
        @endif
        @if ($deskripsi_hero)
        <p class="text-2xl mb-6 max-w-2xl mx-auto">
          {!! $deskripsi_hero->isi_content_web !!}
        </p>
        @endif
        <br>
        <a href="#" class="bg-primary hover:bg-green-800 text-white px-8 py-3 rounded-lg font-semibold transition">Mulai Virtual Tour</a>
      </div>
    </section>

    <!-- Sejarah -->
    <section id="sejarah" class="py-16 bg-white">
      <div class="max-w-5xl mx-auto px-6">

        @if($heading_sejarah_home)
        <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">
          {!! $heading_sejarah_home->isi_content_web !!}
        </h3>
        @else
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Konten Belum Diatur</h3>
        @endif
        <div class="p-8 bg-gray-50 rounded-2xl shadow-xl border border-gray-200">
          
          <div class="md:flex items-start gap-10">
            
            <div class="md:w-1/2 mb-6 md:mb-0">
              
               @if ($sejarah_home)
                <div class="text-justify break-words">
                  {!! $sejarah_home->isi_content_web !!}
                </div>  

                @else
                <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten Sejarah belum diatur.</p>
                @endif
              

              <a href="/sejarah" class="inline-block mt-6 px-5 py-2 text-base bg-primary text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Lihat Selengkapnya &raquo;
              </a>
            </div>
            
            <div class="md:w-1/2">
            @if (isset($gmbr_sejarah_home) && $gmbr_sejarah_home->images->count() > 0)
            @foreach ($gmbr_sejarah_home->images as $image)
              <img 
                 src="{{ asset('storage/' . $image->image_path) }}"
                alt="Gambar Sejarah Trunyan"  
                class="w-full h-80 object-cover rounded-xl shadow-2xl border-4 border-white transform hover:scale-[1.02] transition duration-300">
              <p class="text-center text-sm text-gray-500 mt-2 italic">Desa Trunyan dan pemakaman kuno di bawah pohon Taru Menyan.</p>
              @endforeach
              @else
                <p class="text-center text-xl text-gray-500 italic mt-8">Gambar belum ditambahkan.</p>
              @endif
            </div>
            
          </div>
          
        </div>
      </div>
    </section>

    <!-- Informasi -->
    <section id="informasi" class="py-16 bg-gray-100">
      <div class="max-w-6xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Informasi Wisata</h3>
        <div class="grid md:grid-cols-3 gap-8 text-center">
          <div class="p-6 bg-white rounded-xl shadow hover:scale-105 transition">
            <h4 class="text-xl font-bold mb-2 text-gray-800">📍 Lokasi</h4>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3931.643703793837!2d115.41210807460473!3d-8.271874882694598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1e5ecb8b0c6e3%3A0xd3d2e896d11db8e3!2sDesa%20Trunyan%2C%20Kintamani%2C%20Bangli!5e0!3m2!1sid!2sid!4v1707725120211!5m2!1sid!2sid"
              width="100%"
              height="200"
              style="border:0"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
          <div class="p-6 bg-white rounded-xl shadow hover:scale-105 transition">
            <h4 class="text-xl font-bold mb-3 text-gray-800 text-center">
                Rincian Biaya Pendakian
            </h4>
    
                <p class="text-gray-700 leading-relaxed text-center">
                    Harga Parkir: 
                    <span class="font-bold text-green-700">Rp 10.000</span><br>
                    Loket 1 (Tiket Kawasan): 
                    <span class="font-bold text-green-700">Rp 10.000</span><br>
                    Loket 2 (Retribusi Jalur): 
                    <span class="font-bold text-green-700">Rp 10.000</span>
                </p>

                <p class="mt-3 pt-3 border-t border-gray-300 font-extrabold text-lg text-gray-900 text-center">
                    TOTAL MINIMAL: Rp 30.000
                </p>

                <p class="mt-4 text-xs text-gray-500 italic text-center">
                    *Biaya ini belum termasuk tiket umum (dewasa/anak) dan jasa pemandu.
                </p>
          </div>
          <div class="p-6 bg-white rounded-xl shadow hover:scale-105 transition">
    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Waktu Operasional
    </h4>
    <div class="space-y-2 text-gray-700">
        <p class="font-semibold text-lg">
            <span class="text-primary block mb-1">Hari:</span>
            Setiap Hari (Senin - Minggu)
        </p>
        <p class="font-semibold text-lg pt-2 border-t border-gray-200">
            <span class="text-primary block mb-1">Jam:</span>
            <strong class="text-green-700 text-2xl">24 Jam</strong>
        </p>
    </div>
    <p class="mt-4 text-xs text-gray-500 italic">
        *Pendakian malam/subuh sangat disarankan untuk melihat *sunrise*.
    </p>
</div>
        </div>
         {{-- <h3 class="text-2xl font-semibold text-left mb-10 mt-20 text-black">Informasi Track Pendakian</h3> --}}

      <div class="bg-gray-100  mt-20 rounded-xl max-w-6xl mx-auto text-gray-700">
        <!-- Deskripsi Singkat -->
        @if($heading_informasi_1)
        <h3 class="text-2xl font-bold text-gray-900 mb-4">
          {!! $heading_informasi_1->isi_content_web !!}
        </h3>
        @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
        @endif

        @if($informasi_1)
          <p class="leading-relaxed mb-8 text-justify">
            {!! $informasi_1->isi_content_web !!}
          </p>
          @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
          @endif
        
        <br>

        <!-- Tips Singkat -->
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tips Singkat</h3>
          <ul class="list-disc pl-6 space-y-2">
              <li>Gunakan sepatu trekking atau sepatu dengan grip yang baik.</li>
              <li>Bawa minimal 600ml air minum dan camilan ringan.</li>
              <li>Hindari pendakian saat hujan karena jalur menjadi licin.</li>
              <li>Hormati adat lokal dan jangan memasuki area sakral.</li>
              <li>Buang sampah pada tempatnya dan jaga kebersihan jalur.</li>
              <li>Sinyal seluler mungkin lemah di beberapa titik jalur.</li>
              <li>Bawa senter atau headlamp jika mendaki subuh atau sore.</li>
              <li>Gunakan pakaian yang nyaman dan siap untuk cuaca dingin.</li>
          </ul>
      </div>

      </div>
    </section>

    <!-- Galeri -->
    <section class="bg-white py-12" id="galeri">
      <h2 class="text-3xl font-semibold text-green-600 text-center mb-10">
        Galeri Tracking Bukit Trunyan
      </h2>
      <br>

      <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-8 px-8">
        @if (isset($galeri) && $galeri->images->count() > 0)
        @foreach ($galeri->images as $image)
        <div>
          <img 
          src="{{ asset('storage/' . $image->image_path) }}" alt="Galeri Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div>
        @endforeach
        @else
          <p class="text-center text-xl text-gray-500 italic mt-8">Gambar galeri tidak ditemukan.</p>
        @endif
        {{-- <div>
          <img src="img/2.jpeg" alt="Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div>
        <div>
          <img src="img/3.jpeg" alt="Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div>
        <div>
          <img src="img/4.jpeg" alt="Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div>
        <div>
          <img src="img/5.jpeg" alt="Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div>
        <div>
          <img src="img/6.jpeg." alt="Bukit Trunyan"
            class="w-full h-56 object-cover rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
        </div> --}}
      </div>
    </section>


    <!-- Komentar -->
    <section id="komentar" class="py-16 bg-white">
      <div class="max-w-4xl mx-auto px-6">
        <h3 class="text-3xl font-semibold text-center mb-10 text-primary">Komentar Pengunjung</h3>

        <div id="commentList" class="space-y-4 mb-6 max-h-72 overflow-y-auto pr-2">
          <div class=" p-4 rounded-lg shadow">
           
          </div>
        </div>

        <div class="flex items-center bg-gray-100 rounded-lg p-3 shadow-md">
          <input
            type="text"
            id="newComment"
            placeholder="Tulis komentar..."
            class="flex-grow px-4 py-2 bg-white rounded-lg focus:outline-none border border-green-200 focus:ring-2 focus:ring-green-400"
          />
          <button
            id="sendComment"
            class="ml-3 bg-primary hover:bg-green-500 text-white p-3 rounded-full transition"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </button>
        </div>
        <p class="text-xs text-gray-500 mt-2">*Hanya pengguna yang sudah login dapat mengirim komentar*.</p>
        <br>
          <div class="bg-gray-200 rounded-lg shadow-inner w-full max-w-[103%] h-40"></div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-6 text-center">
      <p>© 2025 Virtual Tour Bukit Trunyan | Dikembangkan untuk Project PBL</p>
    </footer>
   
  </body>
</html>
