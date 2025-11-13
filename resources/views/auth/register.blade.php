<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Virtual Tour Bukit Trunyan</title>
    
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
                    // Warna kustom untuk background input
                    'input-bg': '#6F8567' 
                },
            },
        },
      };
    </script>
</head>
<body class="h-screen bg-cover bg-center flex items-center justify-center relative"
      style="background-image: url('{{ asset('img/11.jpg') }}');">

    <div class="bg-gray-900 bg-opacity-80 w-full max-w-md p-8 rounded-xl shadow-lg">
        
        <h2 class="text-3xl font-bold text-center text-white mb-6">
            Buat Akun Baru
        </h2>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <strong class="font-bold">Oops! Ada masalah:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            
            <div>
                <label for="username" class="block text-sm font-medium text-green-100 mb-1">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                       class="w-full px-4 py-2 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-input-bg bg-opacity-70 text-white placeholder-green-200">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-green-100 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-input-bg bg-opacity-70 text-white placeholder-green-200">
            </div>
            
            <div>
                <label for="nomor_telp" class="block text-sm font-medium text-green-100 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telp" id="nomor_telp" value="{{ old('nomor_telp') }}"
                       class="w-full px-4 py-2 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-input-bg bg-opacity-70 text-white placeholder-green-200">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-green-100 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-input-bg bg-opacity-70 text-white placeholder-green-200">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-green-100 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2 border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-input-bg bg-opacity-70 text-white placeholder-green-200">
            </div>
            
            <button type="submit" 
                    class="w-full bg-primary hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                Register
            </button>
        </form>

        <div class="text-center text-sm text-green-200 mt-6">
            <p>
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
                    Login di sini
                </a>
            </p>
        </div>
        
    </div>
</body>
</html>