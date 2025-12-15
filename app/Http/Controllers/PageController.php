<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentWeb;

class PageController extends Controller
{
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
