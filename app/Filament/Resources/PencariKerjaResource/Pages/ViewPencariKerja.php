<?php

namespace App\Filament\Resources\PencariKerjaResource\Pages;

use App\Filament\Resources\PencariKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPencariKerja extends ViewRecord
{
    protected static string $resource = PencariKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
