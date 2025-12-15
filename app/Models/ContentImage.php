<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    protected $table = 'content_image'; 
    protected $primaryKey = 'id_content_image';

    protected $fillable = [
    'id_content_web', 'image_path',
];
     
    // Gambar dimiliki oleh satu Konten
    public function contentWeb()
    {
        return $this->belongsTo(ContentWeb::class, 'id_content_web', 'id_content_web');
    }
}
