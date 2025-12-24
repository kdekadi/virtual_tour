<?php

namespace App\Filament\Widgets;

use App\Models\Visitor;
use App\Exports\VisitorExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Filament\Actions\Action;
use Filament\Actions\Contracts\HasActions; 
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Support\Contracts\TranslatableContentDriver;



class VisitorChart extends ChartWidget implements HasActions
{
    use InteractsWithActions;
    protected static ?string $maxHeight = '400px';
    protected static ?int $sort = 2; 
    protected static ?string $heading = 'Grafik Pengunjung Bulanan';
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 'full';

    protected function getFilters(): ?array
    {
        $years = Visitor::selectRaw('YEAR(visit_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year', 'year')
            ->toArray();

        return $years ?: [date('Y') => date('Y')];
    }

     // FUNGSI TOMBOL CETAK
    protected function getActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('Cetak Excel')
                ->icon('heroicon-m-arrow-down-tray')
                ->color('success') // Warna hijau Excel
                ->icon('heroicon-s-document-arrow-down')
                ->action(function () {
                    $activeFilter = $this->filter ?: date('Y');
                    return Excel::download(new VisitorExport($activeFilter), "laporan-visitor-{$activeFilter}.xlsx");
                }),
        ];
    }

     public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        return null;
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?: date('Y');
        // 2. Ambil data per bulan berdasarkan filter tahun
        $results = Visitor::selectRaw('MONTH(visit_date) as month, COUNT(*) as count')
            ->whereYear('visit_date', $activeFilter)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Susun array agar selalu ada 12 bulan (Jan-Des) meskipun datanya 0
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $results[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Visitor',
                    'data' => $data,
                    'fill' => 'start',
                    // 'backgroundColor' => '#000000ff', 
                    // 'borderColor' => '#000000ff',
                    'borderRadius' => 4,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }


   

    // ... Simpan fungsi getFilters() dan getData() Anda yang lama di sini ...

    

//     protected function getOptions(): array
// {
//     return [
//         'scales' => [
//             'y' => [
//                 'ticks' => [
//                     'stepSize' => 1, // Memaksa kenaikan angka sebesar 1 (tidak desimal)
//                     'precision' => 0, // Memastikan tidak ada angka di belakang koma
//                 ],
//             ],
//         ],
//     ];
// }

    protected function getType(): string
    {
        return 'bar';
    }
}
