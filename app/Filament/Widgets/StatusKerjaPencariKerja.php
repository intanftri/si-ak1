<?php

namespace App\Filament\Widgets;

use App\Models\PencariKerja;
use Filament\Widgets\ChartWidget;

class StatusKerjaPencariKerja extends ChartWidget
{
    protected static ?string $heading = 'Status Kerja Pencari Kerja';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '260px';
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [
                        PencariKerja::where('status_kerja', 'Aktif')->count(),
                        PencariKerja::where('status_kerja', 'Sudah Bekerja')->count(),
                    ],
                ],
            ],
            'labels' => ['Aktif', 'Sudah Bekerja'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
