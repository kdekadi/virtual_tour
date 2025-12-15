<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<section id="sejarah" class="py-20 bg-neutral-100">
    <div class="max-w-4xl mx-auto px-6">
         @if ($judul_sejarah)
        <h3 class="text-4xl font-serif font-bold text-center mb-12 text-gray-800 tracking-wider">
          {!! $judul_sejarah->isi_content_web !!}
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
            
            <h4 class="text-2xl font-serif font-bold text-red-900 mb-4 tracking-wide">
                Misteri Pemakaman Taru Menyan
            </h4>

            <p class="text-justify leading-relaxed text-lg font-serif text-stone-800 mb-6">
                Tradisi paling mencengangkan adalah sistem adat kematian mereka. Jauh dari kremasi atau penguburan, jenazah diletakkan di bawah pohon keramat **Taru Menyan**. Pohon ini melepaskan aroma wangi nan kuat yang diyakini menetralkan bau jenazah, sebuah fenomena alam yang menguatkan spiritualitas kuno Trunyan.
            </p>
            
            <p class="text-justify leading-relaxed text-lg font-serif text-stone-800">
                Trunyan saat ini tidak hanya menjadi saksi bisu sejarah, tetapi juga destinasi budaya yang memadukan keindahan alam Danau Batur dengan spiritualitas Bali kuno, menjadikannya lokasi penting untuk *tracking*.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus incidunt eum dolor nemo culpa! A nisi sunt amet harum, cumque pariatur rem animi itaque dignissimos deserunt sapiente voluptate. Corrupti, ullam!
                uptatem distinctio illum laboriosam veritatis, aliquid ipsa. Libero atque sit, assumenda necessitatibus hic minima possimus praesentium beatae sint dolorum at dolores numquam a minus eius exercitationem ipsum debitis facilis.
                A enim voluptatibus, maxime reiciendis beatae commodi recusandae neque doloribus porro minus maiores magnam quaerat repudiandae ratione officiis, atque exercitationem quisquam vel totam culpa nobis ad temporibus. Libero, impedit numquam.
                Illum inventore impedit quas doloremque exercitationem nesciunt qui, commodi molestiae sed quo magni, debitis ducimus laudantium mollitia excepturi minus animi ea unde? Tempore odio architecto corrupti odit animi dolorum illo.
                Veritatis tempora iure nostrum delectus quibusdam cupiditate praesentium a quas explicabo incidunt sapiente laborum reprehenderit officia eum inventore numquam nesciunt libero labore, blanditiis ad fugit! Eius doloremque ad deleniti aliquam.
                Beatae sed quidem molestiae soluta cumque distinctio, consequuntur dolorem aspernatur quae. Eos ipsa quaerat corporis consequuntur, dignissimos suscipit ab aliquam, sit perferendis provident porro libero aperiam accusantium aspernatur sapiente iusto?
                Odio necessitatibus natus nobis incidunt libero, sit exercitationem quam tempora veritatis, non neque accusamus animi esse voluptas earum. Ducimus distinctio ipsum dignissimos officiis a ex cumque, earum fugit quae placeat.
                At sapiente nemo laborum minima ducimus ab, minus consectetur vero enim illum itaque provident unde cumque corporis odio? Minus eveniet aliquid dicta officia inventore debitis totam magni veritatis, eos rem!
            </p>

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