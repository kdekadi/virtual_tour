<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentWeb extends Model
{
    protected $table = 'content_web'; 
    protected $primaryKey = 'id_content_web'; 
    protected $fillable = [
    'nama_content_web','label', 'isi_content_web', 'id_users',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function images()
    {
        return $this->hasMany(ContentImage::class, 'id_content_web');
    }
}
