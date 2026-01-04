<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Virtual Tour Bukit Trunyan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <style>
      html {
        scroll-behavior: smooth;
      }
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
        <h1 class="text-xl font-bold text-primary">Bukit Trunyan</h1>

        <!-- Menu Desktop -->
        <ul id="navLinks" class="hidden md:flex space-x-6 text-white font-medium">
            <li><a href="#home" data-link="home" class="nav-link">Home</a></li>
            <li><a href="#sejarah" data-link="sejarah" class="nav-link">Sejarah</a></li>
            <li><a href="#informasi" data-link="informasi" class="nav-link">Informasi</a></li>
            <li><a href="#galeri" data-link="galeri" class="nav-link">Galeri</a></li>
            <li><a href="#komentar" data-link="komentar" class="nav-link">Komentar</a></li>
        </ul>

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

                        @if (Auth::user()->role === 'admin')
                            <a href="/admin" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('profil') }}"  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Profil
                            </a>
                        @endif
                
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

        <!-- Tombol Mobile -->
        <button id="menu-btn" class="md:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        </button>
    </div>
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-inner">
        <ul class="flex flex-col text-center space-y-2 py-3 font-medium">
        <li><a href="#home" class="nav-link-mobile block py-2 hover:bg-green-100">Home</a></li>
        <li><a href="#sejarah" class="nav-link-mobile block py-2 hover:bg-green-100">Sejarah</a></li>
        <li><a href="#informasi" class="nav-link-mobile block py-2 hover:bg-green-100">Informasi</a></li>
        <li><a href="#galeri" class="nav-link-mobile block py-2 hover:bg-green-100">Galeri</a></li>
        <li><a href="#komentar" class="nav-link-mobile block py-2 hover:bg-green-100">Komentar</a></li>

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
     @if (isset($bg_home) && $bg_home->images->count() > 0)
            @foreach ($bg_home->images as $image)
    <section
      id="home"
      class="scroll-mt-24 h-screen bg-cover bg-center flex items-center justify-center relative"
      style="background-image: url('{{ asset('storage/' . $image->image_path) }}');">
    @endforeach
    @else
    <section
      id="home"
      class="scroll-mt-24 h-screen bg-cover bg-center flex items-center justify-center relative"
      style="background-image: url('{{ asset('img/11.jpg') }}');">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Konten Belum Diatur</h3>
    </section>
    @endif
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
    <section id="sejarah" class="scroll-mt-24 py-16 bg-white">
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
            <div class="md:w-1/2 mb-6 md:mb-0 text-justify"> 
               @if ($sejarah_home)
                  {!! $sejarah_home->isi_content_web !!}
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
    <section id="informasi" class="scroll-mt-24 py-16 bg-gray-100">
      <div class="max-w-6xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Informasi Wisata</h3>
        <div class="grid md:grid-cols-4 gap-8 text-center">

          <div class="p-6 bg-white rounded-xl shadow-xl hover:scale-105 transition">
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
          
          <div class="p-6 bg-white rounded-xl shadow-xl hover:scale-105 transition">
            <h4 class="text-xl font-bold mb-3 text-gray-800 text-center">
                Rincian Biaya
            </h4>
                @if($biaya_pendakian)
                <p class="text-gray-700 leading-relaxed text-center">
                    {!! $biaya_pendakian->isi_content_web !!}    
                </p>
                @else
                  <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
                @endif
            </div>

            <div class="p-6 bg-white rounded-xl shadow-xl hover:scale-105 transition">
                <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center justify-center">
                    Waktu Operasional
                </h4>
                @if($waktu_operasional)
                <div class="space-y-2">
                    <p class="text-gray-700 leading-relaxed text-center">           
                        {!! $waktu_operasional->isi_content_web !!}
                    </p>
                @else
                    <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
                @endif
                </div>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-xl hover:scale-105 transition flex flex-col justify-between">
                <div>
                  <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center justify-center">
                    Cuaca Hari Ini
                </h4>
                @if(isset($data) && $data)
                    <div class="flex flex-col items-center py-2">
                        <div class="flex items-center space-x-2">
                            <img src="http://openweathermap.org/img/wn/{{ $data['weather'][0]['icon'] }}@2x.png" 
                                class="w-16 h-16" alt="weather-icon">
                            <span class="text-4xl font-bold text-gray-800">{{ round($data['main']['temp']) }}°C</span>
                        </div>
                        
                        <p class="text-lg font-medium text-green-600 capitalize">
                            {{ $data['weather'][0]['description'] }}
                        </p>

                        <div class="grid grid-cols-2 gap-4 mt-4 w-full border-t border-gray-100 pt-4">
                            <div class="text-center">
                                <p class="text-xs text-gray-500">Kelembapan</p>
                                <p class="font-semibold text-gray-700">{{ $data['main']['humidity'] }}%</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500">Kecepatan Angin</p>
                                <p>{{ number_format($data['wind']['speed'] * 3.6) }} km/jam</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-10 text-center">
                        <p class="text-gray-400 italic text-sm">Data cuaca tidak tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
        <div class="bg-gray-100 text-justify  mt-20 rounded-xl max-w-6xl mx-auto text-gray-700">
          <!-- Deskripsi -->
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
            
          @if($heading_informasi_2)
          <h3 class="text-2xl font-bold text-gray-900 mb-4">
            {!! $heading_informasi_2->isi_content_web !!}
          </h3>
          @else
              <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
          @endif
          @if($tips)
          <p class="text-2xl font-bold text-gray-900 mb-4">
            {!! $tips->isi_content_web !!}
          </p>
          @else
              <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
          @endif
        </div>
      </div>
    </section>

    <!-- Galeri -->
 <section class="scroll-mt-24 bg-white py-12" id="galeri" x-data="{ open: false, imageSrc: '' }">
    <h2 class="text-3xl font-semibold text-gray-800 text-center mb-10">
        Galeri Tracking Bukit Trunyan
    </h2>

    <div class="grid grid-cols-2 px-4 sm:grid-cols-2 md:grid-cols-3 gap-8 px-10">
        @if (isset($galeri) && $galeri->images->count() > 0)
            @foreach ($galeri->images as $image)
                <div class="shadow-2xl cursor-pointer" 
                     @click="open = true; imageSrc = '{{ asset('storage/' . $image->image_path) }}'">
                    <img 
                        src="{{ asset('storage/' . $image->image_path) }}" 
                        alt="Galeri Bukit Trunyan"
                        class="w-full h-64 object-cover rounded-xl shadow-2xl hover:scale-105 transition-transform duration-300" />
                </div>
            @endforeach
        @else
            <p class="text-center text-xl text-gray-500 italic mt-8">Gambar galeri tidak ditemukan.</p>
        @endif
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 p-4"
         x-cloak
         @click.self="open = false"
         @keydown.escape.window="open = false">
        <button @click="open = false" class="absolute top-5 right-5 text-white text-4xl font-bold">&times;</button>
        <img :src="imageSrc" class="max-w-full max-h-full rounded-lg shadow-white/10 shadow-2xl">
    </div>
</section>


    <!-- Komentar -->
    <section id="komentar" class="scroll-mt-24 py-16 bg-white">
        <h3 class="text-3xl font-bold text-center mb-12">Komentar Pengunjung</h3>
        @livewire('komentar-section')
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-6 text-center">
      <p>© 2025 Virtual Tour Track Pendakian Bukit Trunyan | Dikembangkan untuk Project PBL</p>
    </footer>
   
  </body>
</html>
