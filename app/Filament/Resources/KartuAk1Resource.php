<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KartuAk1Resource\Pages;
use App\Filament\Resources\KartuAk1Resource\RelationManagers;
use App\Models\KartuAk1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class KartuAk1Resource extends Resource
{
    protected static ?string $model = KartuAk1::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Kartu AK1';

    protected static ?string $modelLabel = 'Kartu AK1';

    protected static ?string $pluralModelLabel = 'Kartu AK1';

    protected static ?string $navigationGroup = 'Layanan Ketenagakerjaan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi AK1')
                    ->description('Kartu AK1 dibuat otomatis oleh sistem')
                    ->schema([
                        Forms\Components\Select::make('pencari_kerja_id')
                            ->label('Pencari Kerja')
                            ->relationship('pencariKerja', 'nama')
                            ->searchable()
                            ->preload()
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Terhubung otomatis dengan data pencari kerja'),

                        Forms\Components\TextInput::make('nomor_ak1')
                            ->label('Nomor AK1')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Dibuat otomatis'),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('tanggal_terbit')
                                    ->label('Tanggal Terbit')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->native(false),

                                Forms\Components\DatePicker::make('tanggal_berlaku')
                                    ->label('Tanggal Berlaku')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->native(false),
                            ]),

                        Forms\Components\TextInput::make('file_pdf')
                            ->label('File AK1 (PDF)')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Belum tersedia')
                            ->helperText('File akan tersedia setelah proses cetak'),
                    ]),
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

                Tables\Columns\TextColumn::make('nomor_ak1')
                    ->label('Nomor AK1')
                    ->badge()
                    ->copyable()
                    ->copyMessage('Nomor AK1 disalin')
                    ->color('info'),

                Tables\Columns\TextColumn::make('tanggal_terbit')
                    ->label('Tgl Terbit')
                    ->date('d M Y')
                    ->icon('heroicon-o-calendar'),

                Tables\Columns\TextColumn::make('tanggal_berlaku')
                    ->label('Masa Berlaku')
                    ->badge()
                    ->date('d M Y')
                    ->color(
                        fn($state) =>
                        Carbon::parse($state)->isPast()
                        ? 'danger'
                        : 'success'
                    )
                    ->icon(
                        fn($state) =>
                        Carbon::parse($state)->isPast()
                        ? 'heroicon-o-x-circle'
                        : 'heroicon-o-check-circle'
                    ),

                Tables\Columns\TextColumn::make('file_pdf')
                    ->label('File AK1')
                    ->icon('heroicon-o-document-text')
                    ->formatStateUsing(fn($state) => $state ? 'Lihat PDF' : '-')
                    ->url(
                        fn($record) => $record->file_pdf
                        ? asset('storage/' . $record->file_pdf)
                        : null
                    )
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ManageKartuAk1s::route('/'),
        ];
    }
}
