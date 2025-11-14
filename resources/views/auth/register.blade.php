<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Virtual Tour Bukit Trunyan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                },
            },
        },
      };
    </script>
</head>

<body class="h-screen bg-cover bg-center flex items-center justify-center relative font-sans"
      style="background-image: url('{{ asset('img/11.jpg') }}');">
    <div class="relative bg-gray-900 bg-opacity-80 w-full max-w-md p-8 rounded-xl shadow-2xl">
        
        <h2 class="text-3xl font-bold text-center text-white mb-2">
            Daftar Akun
        </h2>
        
        @if ($errors->any() && !$errors->first('username') && !$errors->first('email') && !$errors->first('nomor_telp') && !$errors->first('password'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm" role="alert">
                <strong class="font-bold">Gagal Registrasi!</strong> Cek kembali input Anda.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <div>
                <input type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}" required autofocus
                        class="w-full px-1 py-2 bg-transparent text-white border-b-2 border-primary focus:outline-none focus:border-green-400 placeholder-gray-400 transition 
                        @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required
                        class="w-full px-1 py-2 bg-transparent text-white border-b-2 border-primary focus:outline-none focus:border-green-400 placeholder-gray-400 transition
                        @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <input type="text" name="nomor_telp" id="nomor_telp" placeholder="Nomor Telepon" value="{{ old('nomor_telp') }}"
                        class="w-full px-1 py-2 bg-transparent text-white border-b-2 border-primary focus:outline-none focus:border-green-400 placeholder-gray-400 transition
                        @error('nomor_telp') border-red-500 @enderror">
                @error('nomor_telp')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password" id="password" required placeholder="Password"
                        class="w-full px-1 py-2 bg-transparent text-white border-b-2 border-primary focus:outline-none focus:border-green-400 placeholder-gray-400 transition
                        @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Konfirmasi Password"
                        class="w-full px-1 py-2 bg-transparent text-white border-b-2 border-primary focus:outline-none focus:border-green-400 placeholder-gray-400 transition">
                @error('password_confirmation')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-primary hover:bg-green-700 text-white px-8 py-3 rounded-full font-semibold transition shadow-lg transform hover:scale-[1.01]">
                    DAFTAR
                </button>
            </div>
        </form>

        <div class="text-center text-sm mt-8">
            <p class="text-gray-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-primary hover:text-green-400 hover:underline transition">
                    Login di sini
                </a>
            </p>
        </div>
    </div>
</body>
</html>