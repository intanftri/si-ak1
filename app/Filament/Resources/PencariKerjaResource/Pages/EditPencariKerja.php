<?php

namespace App\Filament\Resources\PencariKerjaResource\Pages;

use App\Filament\Resources\PencariKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPencariKerja extends EditRecord
{
    protected static string $resource = PencariKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
