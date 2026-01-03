<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencariKerjaResource\Pages;
use App\Filament\Resources\PencariKerjaResource\RelationManagers;
use App\Models\PencariKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PencariKerjaResource extends Resource
{
    protected static ?string $model = PencariKerja::class;
    // Ikon lebih relevan dengan pencari kerja
    protected static ?string $navigationIcon = 'heroicon-o-users';

    // Label yang tampil di sidebar
    protected static ?string $navigationLabel = 'Pencari Kerja';

    // Judul plural di halaman index
    protected static ?string $pluralModelLabel = 'Pencari Kerja';

    // Judul singular
    protected static ?string $modelLabel = 'Pencari Kerja';

    // Kelompok menu di sidebar
    protected static ?string $navigationGroup = 'Layanan Ketenagakerjaan';

    // Urutan menu (semakin kecil, semakin atas)
    protected static ?int $navigationSort = 1;

    // Badge jumlah data
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    // Warna badge
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pribadi')
                    ->description('Informasi identitas pencari kerja')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nik')
                                    ->label('NIK')
                                    ->placeholder('Masukkan NIK sesuai KTP')
                                    ->required()
                                    ->numeric()
                                    ->maxLength(16)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Lengkap')
                                    ->placeholder('Masukkan nama lengkap')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('tempat_lahir')
                                    ->label('Tempat Lahir')
                                    ->placeholder('Contoh: Bontang')
                                    ->maxLength(50),

                                Forms\Components\DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->placeholder('Pilih tanggal lahir')
                                    ->native(false),
                            ]),

                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->placeholder('Pilih jenis kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->native(false)
                            ->required(),
                    ]),

                Forms\Components\Section::make('Kontak & Alamat')
                    ->description('Informasi yang dapat dihubungi')
                    ->schema([
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->placeholder('Masukkan alamat lengkap')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('no_hp')
                                    ->label('No. HP')
                                    ->placeholder('Contoh: 08xxxxxxxxxx')
                                    ->tel()
                                    ->maxLength(15),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->placeholder('Contoh: email@gmail.com')
                                    ->email()
                                    ->maxLength(100),
                            ]),
                    ]),

                Forms\Components\Section::make('Data Ketenagakerjaan')
                    ->description('Informasi status dan pendidikan')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('pendidikan_id')
                                    ->label('Pendidikan Terakhir')
                                    ->placeholder('Pilih pendidikan terakhir')
                                    ->relationship('pendidikan', 'jenjang')
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->required(),

                                Forms\Components\Select::make('status_kerja')
                                    ->label('Status Kerja')
                                    ->placeholder('Pilih status kerja')
                                    ->options([
                                        'Aktif' => 'Aktif',
                                        'Sudah Bekerja' => 'Sudah Bekerja',
                                    ])
                                    ->default('Aktif')
                                    ->native(false)
                                    ->required(),

                                Forms\Components\DatePicker::make('tanggal_daftar')
                                    ->label('Tanggal Pendaftaran')
                                    ->placeholder('Pilih tanggal pendaftaran')
                                    ->default(now())
                                    ->native(false),

                                Forms\Components\Select::make('skills')
                                    ->label('Keahlian')
                                    ->placeholder('Pilih Keahlian')
                                    ->relationship('skills', 'nama')
                                    ->columns(3)
                                    ->searchable()
                                    ->multiple()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('nama')
                                            ->label('Nama Skill')
                                            ->placeholder('Masukkan Nama Skill')
                                            ->required(),
                                    ])
                                    ->native()
                                    ->preload()
                                    ->searchable()
                                    ->helperText('Tambah / Pilih satu atau lebih keahlian yang dimiliki'),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('pendidikan.jenjang')
                    ->label('Pendidikan')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('status_kerja')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Sudah Bekerja' => 'warning',
                        default => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'Aktif' => 'heroicon-o-check-circle',
                        'Sudah Bekerja' => 'heroicon-o-briefcase',
                        default => 'heroicon-o-question-mark-circle',
                    }),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('tanggal_daftar')
                    ->label('Tgl Daftar')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_kerja')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Sudah Bekerja' => 'Sudah Bekerja',
                    ]),

                Tables\Filters\SelectFilter::make('pendidikan')
                    ->relationship('pendidikan', 'jenjang'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPencariKerjas::route('/'),
            'create' => Pages\CreatePencariKerja::route('/create'),
            'view' => Pages\ViewPencariKerja::route('/{record}'),
            'edit' => Pages\EditPencariKerja::route('/{record}/edit'),
        ];
    }
}
