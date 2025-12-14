<?php

namespace App\Filament\Resources\KartuAk1Resource\Pages;

use App\Filament\Resources\KartuAk1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKartuAk1s extends ManageRecords
{
    protected static string $resource = KartuAk1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
