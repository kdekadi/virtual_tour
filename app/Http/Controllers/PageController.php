<?php

namespace App\Http\Controllers;

use App\Models\ContentWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
    $user = Auth::user(); // otomatis ambil dari tabel users

    return view('profil', compact('user'));
}

    

   public function index()
{
    $sejarah_home = ContentWeb::with('images')
        ->where('nama_content_web', 'sejarah_home') // sesuaikan key 
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

    return view('landingpage', [
        'sejarah_home' => $sejarah_home,
        'heading_hero' => $heading_hero,
        'deskripsi_hero' => $deskripsi_hero,
        'galeri' => $galeri,
        'heading_sejarah_home' => $heading_sejarah_home,
        'gmbr_sejarah_home' => $gmbr_sejarah_home,
        'informasi_1' => $informasi_1,
        'heading_informasi_1' => $heading_informasi_1,

    ]);

   



}

    public function showSejarah()
    {
        $judul_sejarah = ContentWeb::with('images')
            ->where('nama_content_web', 'judul_sejarah') 
            ->first();

        $gmbr_sejarang_lengkap = ContentWeb::where('nama_content_web', 'gmbr_sejarah_lengkap')
            ->with('images') 
            ->first();

        $sejarah_lengkap_1 = ContentWeb::where('nama_content_web', 'sejarah_lengkap_1') 
        ->first();


         return view('sejarah', [
        'judul_sejarah' => $judul_sejarah,
        'gmbr_sejarah_lengkap' => $gmbr_sejarang_lengkap,
        'sejarah_lengkap_1' => $sejarah_lengkap_1,
    ]);
    }

}
