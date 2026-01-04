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
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function getFilamentName(): string
{
    return $this->username;
}

    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    public $timestamps = false; 

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

    public function contentWebs()
    {
        return $this->hasMany(ContentWeb::class, 'id_users');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_users');
    }

    
}
