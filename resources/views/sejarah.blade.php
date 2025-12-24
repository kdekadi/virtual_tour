<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Sejarah Lengkap Bukit Trunyan</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<section id="sejarah" class="py-20 bg-neutral-100">
    <div class="max-w-4xl mx-auto px-6">
         @if ($judul_sejarah_lengkap_1)
        <h3 class="text-4xl font-serif font-bold text-center mb-12 text-gray-800 tracking-wider">
          {!! $judul_sejarah_lengkap_1->isi_content_web !!}
          </h3>
        
        @endif

        <div class="p-8 bg-gray-50 rounded-2xl shadow-xl border border-gray-200">
            @if ($gmbr_sejarah_lengkap && $gmbr_sejarah_lengkap->images->count() > 0)
            @foreach ($gmbr_sejarah_lengkap->images as $image)
            <div class="mb-8">
                <img 
                    src="{{ asset('storage/' . $image->image_path) }}"
                    alt="Foto Bukit Trunyan"  
                    class="w-full h-72 object-cover rounded-lg border-2 border-stone-400 opacity-90">
                {{-- <p class="text-center text-sm text-stone-600 mt-3 italic font-serif">Pintu gerbang Desa Bali Aga di tepi Danau Batur.</p> --}}
            </div>
            @endforeach
            @else
            <p class="text-center text-xl text-gray-500 italic mt-8">Gambar galeri tidak ditemukan.</p>
            @endif

            @if($sejarah_lengkap_1)
            <p class="text-justify leading-relaxed text-xl font-serif text-stone-800 mb-6 border-b border-stone-300 pb-4">
                <div class="text-justify break-words">
                {!! $sejarah_lengkap_1->isi_content_web !!}
                </div>
            </p>
             @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
            @endif
            
            @if($heading_sejarah_lengkap_1)
            <h4 class="text-2xl font-serif font-bold text-red-900 mb-4 tracking-wide">
                {!! $judul_sejarah_lengkap_1->isi_content_web !!}
            </h4>
            @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
            @endif

            @if($sejarah_lengkap_2)
            <p class="text-justify leading-relaxed text-xl font-serif text-stone-800 mb-6 border-b border-stone-300 pb-4">
                <div class="text-justify break-words">
                {!! $sejarah_lengkap_2->isi_content_web !!}
                </div>
            </p>
             @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
            @endif
            <br>
            
             @if($judul_sejarah_lengkap_3)
            <h4 class="text-2xl font-serif font-bold text-red-900 mb-4 tracking-wide">
                {!! $judul_sejarah_lengkap_3->isi_content_web !!}
            </h4>
            @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
            @endif

             @if($sejarah_lengkap_3)
            <p class="text-justify leading-relaxed text-xl font-serif text-stone-800 mb-6 border-b border-stone-300 pb-4">
                <div class="text-justify break-words">
                {!! $sejarah_lengkap_3->isi_content_web !!}
                </div>
            </p>
             @else
            <p class="text-justify leading-relaxed text-base text-gray-700 mt-4">Konten belum diatur.</p>
            @endif


            <div class="text-left mt-8">
                <a href="/#sejarah" class="inline-block px-8 py-3 text-lg bg-green-700 text-white font-bold rounded-lg shadow-xl hover:bg-green-800 transition transform hover:scale-105">
                   &laquo; Kembali ke Home
                </a>
            </div>
            
        </div>
        
    </div>
</section>
   
</body>
</html>