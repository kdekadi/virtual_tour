<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentWeb extends Model
{
    protected $table = 'content_web'; 
    protected $primaryKey = 'id_content_web'; 
    public $timestamps = false; // Karena nama kolomnya beda

    // Konten diedit satu User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    // Konten punya banyak gambar
    public function images()
    {
        return $this->hasMany(ContentImage::class, 'id_content_web');
    }
}
