<?php

namespace App\Filament\Widgets;

use App\Models\User; 
use App\Models\Visitor; 
use Filament\Widgets\StatsOverviewWidget\Stat; 
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class JumlahPengunjungWidget extends BaseWidget
{
    protected static ?int $sort = 1; 
    protected function getStats(): array
    {
        // 3. Tulis query untuk menghitung pengunjung
        $jumlah = User::where('role', 'pengunjung')->count();

        // 4. Kembalikan data dalam bentuk Stat card
       return [
            // 1. Total Visitor Login
            Stat::make('Total visitor login', User::where('role', 'pengunjung')->count())
                ->description('Jumlah akun visitor terdaftar')
                ->icon('heroicon-o-users')
                ->color('primary'),
            
            // 2. Total Admin
            Stat::make('Total Admin', User::where('role', 'admin')->count())
                ->icon('heroicon-o-shield-check')
                ->color('danger'),

            // 3. Visitor Hari Ini (Pindahan dari widget lama)
            Stat::make('Visitor Hari Ini', Visitor::whereDate('visit_date', now())->count())
                ->description('Pengunjung unik hari ini')
                ->icon('heroicon-m-user-group')
                ->color('success'),

            // 4. Total Visitor Bulan Ini (Pindahan dari widget lama)
            Stat::make('Total Visitor (Bulan Ini)', Visitor::whereMonth('visit_date', now()->month)->count())
                ->description('Akumulasi bulan ini')
                ->icon('heroicon-m-chart-bar')
                ->color('info'),
                
        ];
    }
}