<?php

namespace App\Filament\Resources\PencariKerjaResource\Pages;

use App\Filament\Resources\PencariKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencariKerjas extends ListRecords
{
    protected static string $resource = PencariKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
