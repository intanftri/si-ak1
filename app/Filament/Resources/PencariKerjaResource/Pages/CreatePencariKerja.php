<?php

namespace App\Filament\Resources\PencariKerjaResource\Pages;

use App\Filament\Resources\PencariKerjaResource;
use App\Models\KartuAk1;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePencariKerja extends CreateRecord
{
    protected static string $resource = PencariKerjaResource::class;

    protected function afterCreate(): void
    {
        $pencariKerja = $this->record;

        // Cegah duplikasi AK1
        if ($pencariKerja->kartuAk1()->exists()) {
            return;
        }

        $pencariKerja->kartuAk1()->create([
            'nomor_ak1' => $this->generateNomorAk1(),
            'tanggal_terbit' => now(),
            'tanggal_berlaku' => now()->addYears(2),
        ]);
    }

    private function generateNomorAk1(): string
    {
        return 'AK1-' . date('Y') . '-' . str_pad(
            KartuAk1::count() + 1,
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}
