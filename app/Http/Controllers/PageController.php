<?php

namespace App\Http\Controllers;

use App\Models\ContentWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class PageController extends Controller
{

     public function edit()
    {
        return view('edit_profil', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'   => 'required|string|max:45',
            'email'      => 'required|email|max:100|unique:users,email,' . $user->id_users . ',id_users',
            'nomor_telp' => 'nullable|string|max:45',
            'password'   => 'nullable|min:6|confirmed',
        ]);

        $user->username   = $request->username;
        $user->email      = $request->email;
        $user->nomor_telp = $request->nomor_telp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil diperbarui');
    }
        public function profil()
{
    $user = Auth::user(); 

    return view('profil', compact('user'));
}

   public function index()
{
 
    $apiKey = env('OPENWEATHER_API_KEY');
    $lat = "-8.2125"; 
    $lon = "115.3835";
    $data = null;

    try {
        $response = Http::timeout(5)->withoutVerifying()->get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'id'
        ]);

        if ($response->successful()) {
            $data = $response->json();
        }
    } catch (\Exception $e) {
        \Log::error("Gagal koneksi ke OpenWeather: " . $e->getMessage());
    }


    $sejarah_home = ContentWeb::with('images')
        ->where('nama_content_web', 'sejarah_home') 
        ->first();

    $heading_hero = ContentWeb::where('nama_content_web', 'heading_hero') 
        ->first();

    $deskripsi_hero = ContentWeb::with('images')
        ->where('nama_content_web', 'deskripsi_hero') 
        ->first();

    $galeri = ContentWeb::with('images')
        ->where('nama_content_web', 'galeri') 
        ->first();

    $heading_sejarah_home = ContentWeb::where('nama_content_web', 'heading_sejarah_home') 
        ->first();

    $gmbr_sejarah_home = ContentWeb::with('images')
        ->where('nama_content_web', 'gmbr_sejarah_home') 
        ->first();

    $heading_informasi_1 = ContentWeb::where('nama_content_web', 'heading_informasi_1') 
        ->first();
    
    $informasi_1 = ContentWeb::where('nama_content_web', 'informasi_1') 
        ->first();

    $heading_informasi_2 = ContentWeb::where('nama_content_web', 'heading_informasi_2') 
        ->first();

    $biaya_pendakian = ContentWeb::where('nama_content_web', 'biaya_pendakian') 
        ->first();

    $waktu_operasional = ContentWeb::where('nama_content_web', 'waktu_operasional') 
        ->first();

     $tips = ContentWeb::where('nama_content_web', 'tips') 
        ->first();

    return view('landingpage', [
        'data' => $data,
        'sejarah_home' => $sejarah_home,
        'heading_hero' => $heading_hero,
        'deskripsi_hero' => $deskripsi_hero,
        'galeri' => $galeri,
        'heading_sejarah_home' => $heading_sejarah_home,
        'gmbr_sejarah_home' => $gmbr_sejarah_home,
        'informasi_1' => $informasi_1,
        'heading_informasi_1' => $heading_informasi_1,
        'heading_informasi_2' => $heading_informasi_2,
        'biaya_pendakian' => $biaya_pendakian,
        'waktu_operasional' => $waktu_operasional,
        'tips' => $tips,
    ]);
}

    public function showSejarah()
    {
        $judul_sejarah_lengkap_1 = ContentWeb::with('images')
            ->where('nama_content_web', 'judul_sejarah') 
            ->first();

        $gmbr_sejarang_lengkap = ContentWeb::where('nama_content_web', 'gmbr_sejarah_lengkap')
            ->with('images') 
            ->first();

        $sejarah_lengkap_1 = ContentWeb::where('nama_content_web', 'sejarah_lengkap_1') 
            ->first();

        $heading_sejarah_lengkap_1 = ContentWeb::where('nama_content_web', 'heading_sejarah_lengkap_1') 
            ->first();

        $judul_sejarah_lengkap_3 = ContentWeb::where('nama_content_web', 'judul_sejarah_lengkap_3') 
            ->first();

        $sejarah_lengkap_2 = ContentWeb::where('nama_content_web', 'sejarah_lengkap_2') 
            ->first();

        $sejarah_lengkap_3 = ContentWeb::where('nama_content_web', 'sejarah_lengkap_3') 
            ->first();


        return view('sejarah', [
        'judul_sejarah_lengkap_1' => $judul_sejarah_lengkap_1,
        'gmbr_sejarah_lengkap' => $gmbr_sejarang_lengkap,
        'sejarah_lengkap_1' => $sejarah_lengkap_1,
        'heading_sejarah_lengkap_1' => $heading_sejarah_lengkap_1,
        'judul_sejarah_lengkap_3' => $judul_sejarah_lengkap_3,
        'sejarah_lengkap_2' => $sejarah_lengkap_2,
        'sejarah_lengkap_3' => $sejarah_lengkap_3,


    ]);
    }

}
