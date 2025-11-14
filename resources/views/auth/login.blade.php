<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Virtual Tour Bukit Trunyan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
      tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                },
                colors: {
                    primary: "#16a34a",
                    light: "#f0fdf4",
                    // BARIS BARU: Menambahkan warna kustom Anda
                    'placeholder-custom': '#6F8567',
                },
            },
        },
      };
    </script>
</head>
<body class="h-screen bg-cover bg-center flex items-center justify-center relative"
      style="background-image: url('{{ asset('img/11.jpg') }}');">

    <div class="bg-gray-900 bg-opacity-80 w-full max-w-md p-8 rounded-xl shadow-lg">
        
        <h2 class="text-3xl font-bold text-center text-white mb-2">
            Login
        </h2>

        <div class="w-24 h-px bg-primary mx-auto mb-8"></div>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <strong class="font-bold">Oops! Ada kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-8">
            @csrf
            
            <div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        placeholder="Email"
                        class="w-full px-1 py-2 bg-transparent border-b-2 border-primary text-white placeholder-placeholder-custom focus:outline-none focus:border-green-400">
            </div>
            
            <div>
                <input type="password" name="password" id="password" required
                        placeholder="Password"
                        class="w-full px-1 py-2 bg-transparent border-b-2 border-primary text-white placeholder-placeholder-custom focus:outline-none focus:border-green-400">
            </div>
            
            <button type="submit" 
                    class="w-full bg-primary hover:bg-green-600 text-white px-8 py-3 rounded-full font-semibold transition">
                Login
            </button>
        </form>

        <div class="text-center text-sm text-placeholder-custom mt-6">
            <p>
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
                    Daftar di sini
                </a>
            </p>
        </div>
        
    </div>
</body>
</html>