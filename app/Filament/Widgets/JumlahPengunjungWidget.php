<?php

namespace App\Filament\Widgets;

// 1. Impor model User
use App\Models\User; 
// 2. Impor class Stat
use Filament\Widgets\StatsOverviewWidget\Stat; 
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class JumlahPengunjungWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // 3. Tulis query untuk menghitung pengunjung
        $jumlah = User::where('role', 'pengunjung')->count();

        // 4. Kembalikan data dalam bentuk Stat card
        return [
            Stat::make('Total Pengunjung', $jumlah)
                ->description('Jumlah akun pengunjung terdaftar')
                ->icon('heroicon-o-users'),
            
            // Kamu bisa menambahkan Stat::make(...) lain di sini
            // misalnya, total admin
            Stat::make('Total Admin', User::where('role', 'admin')->count())
                ->icon('heroicon-o-shield-check'),
        ];
    }
}