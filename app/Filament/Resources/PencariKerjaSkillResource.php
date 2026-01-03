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
    protected static ?string $label = 'Relasi Keahlian';
    protected static ?string $pluralLabel = 'Pencari Kerja & Keahlian';

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $activeNavigationIcon = 'heroicon-s-link';

    protected static ?string $navigationBadgeTooltip = 'Total Relasi Skill';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Relasi Pencari Kerja & Keahlian')
                    ->description('Hubungkan pencari kerja dengan keahlian yang dimiliki')
                    ->schema([
                        Forms\Components\Select::make('pencari_kerja_id')
                            ->label('Pencari Kerja')
                            ->relationship('pencariKerja', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->getOptionLabelFromRecordUsing(
                                fn($record) => "{$record->nama} ({$record->nik})"
                            ),

                        Forms\Components\Select::make('skill_id')
                            ->label('Keahlian')
                            ->relationship('skill', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pencariKerja.nama')
                    ->label('Pencari Kerja')
                    ->description(fn($record) => 'NIK: ' . $record->pencariKerja->nik)
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('skill.nama')
                    ->label('Keahlian')
                    ->badge()
                    ->color('info')
                    ->searchable(),
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
