<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use App\Exports\VisitorExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('Cetak Data Pengunjung Bulanan')
                ->icon('heroicon-m-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return Excel::download(new VisitorExport(date('Y')), 'laporan-visitor.xlsx');
                }),

           
        Action::make('openLandingPage')
            ->label('Lihat Website')
            ->icon('heroicon-m-globe-alt')
            ->color('info')
            ->url(url('/')) 
            ->openUrlInNewTab(), 
        
        ];
    }
}