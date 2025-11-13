<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    // Fungsi yang wajib ada untuk Filament
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya user dengan role 'admin' yang bisa akses panel
        return $this->role === 'admin';
    }

    public function getFilamentName(): string
{
    return $this->username;
}

    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    public $timestamps = false; // karena di tabel kamu tidak ada created_at & updated_at

    protected $fillable = [
        'username',
        'email',
        'password',
        'nomor_telp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // relasi ke tabel konten
    public function contentWebs()
    {
        return $this->hasMany(ContentWeb::class, 'id_users');
    }

    // relasi ke tabel komentar
    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_users');
    }

    
}
