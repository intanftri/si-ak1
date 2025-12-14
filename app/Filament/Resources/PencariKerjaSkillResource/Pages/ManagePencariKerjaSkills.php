<?php

namespace App\Filament\Resources\PencariKerjaSkillResource\Pages;

use App\Filament\Resources\PencariKerjaSkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePencariKerjaSkills extends ManageRecords
{
    protected static string $resource = PencariKerjaSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
