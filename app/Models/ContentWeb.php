<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentWeb extends Model
{
    protected $table = 'content_web'; 
    protected $primaryKey = 'id_content_web'; 
    // public $timestamps = false; // Karena nama kolomnya beda
    

    protected $fillable = [
    'nama_content_web', 'isi_content_web', 'id_users',
    ];

    // Konten diedit satu User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    // Konten punya banyak gambar
    public function images()
    {
        return $this->hasMany(ContentImage::class, 'id_content_web');
    }
}
