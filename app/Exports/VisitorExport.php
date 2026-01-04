<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class VisitorExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithCustomStartCell
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    /**
     * Kita mulai tabel dari baris ke-4 agar ada ruang untuk judul di atasnya.
     */
    public function startCell(): string
    {
        return 'A4';
    }

    public function collection()
    {
        return Visitor::selectRaw('MONTHNAME(visit_date) as bulan, COUNT(*) as total')
            ->whereYear('visit_date', $this->year)
            ->groupByRaw('MONTHNAME(visit_date), MONTH(visit_date)')
            ->orderByRaw('MONTH(visit_date) ASC')
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Bulan', 'Total Pengunjung'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // 1. Menambahkan Judul Laporan secara manual di baris pertama
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'LAPORAN DATA PENGUNJUNG');
        
        // 2. Menambahkan Informasi Tahun di baris kedua
        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A2', 'Tahun: ' . $this->year);

        return [
            // Style untuk Judul Utama (Baris 1)
            1 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            
            // Style untuk Keterangan Tahun (Baris 2)
            2 => [
                'font' => ['bold' => true, 'size' => 12],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],

            // Style untuk Header Tabel (Baris 4 - karena startCell di A4)
            4 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '22C55E'], // Warna Hijau Filament
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],

            // Memberikan border ke seluruh sel yang berisi data (asumsi maksimal 12 bulan + header)
            'A4:B16' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}