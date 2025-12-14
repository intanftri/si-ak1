<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencariKerjaSkillResource\Pages;
use App\Filament\Resources\PencariKerjaSkillResource\RelationManagers;
use App\Models\PencariKerjaSkill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PencariKerjaSkillResource extends Resource
{
    protected static ?string $model = PencariKerjaSkill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pencari_kerja_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('skill_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pencari_kerja_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('skill_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePencariKerjaSkills::route('/'),
        ];
    }
}
