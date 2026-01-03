<?php

namespace App\Filament\Widgets;

use App\Models\KartuAk1;
use App\Models\PencariKerja;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $totalPencariKerja = PencariKerja::count();
        $totalAktif = KartuAk1::whereDate('tanggal_berlaku', '>=', now())->count();
        $sudahBekerja = PencariKerja::where('status_kerja', 'Sudah Bekerja')->count();
        return [
            Stat::make('Total Pencari Kerja', $totalPencariKerja)
                ->description('Data terdaftar di sistem')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('AK1 Aktif', $totalAktif)
                ->description('Masih berlaku')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Sudah Bekerja', $sudahBekerja)
                ->description('Pencari kerja terserap')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'),
        ];
    }
}
