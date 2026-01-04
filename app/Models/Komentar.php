<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar'; 
    protected $primaryKey = 'id_komentar'; 
    const CREATED_AT = 'waktu_komentar';
    const UPDATED_AT = null;
    protected $fillable = ['isi_komentar', 'id_users', 'parent_id', 'is_read', 'waktu_komentar'];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function replies() {
        return $this->hasMany(Komentar::class, 'parent_id', 'id_komentar');
    }

    public function parent() {
        return $this->belongsTo(Komentar::class, 'parent_id', 'id_komentar');
    }


}
