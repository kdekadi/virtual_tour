<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    protected $table = 'content_image'; 
    protected $primaryKey = 'id_content_image';
     
    // Gambar dimiliki oleh satu Konten
    public function contentWeb()
    {
        return $this->belongsTo(ContentWeb::class, 'id_content_web');
    }
}
