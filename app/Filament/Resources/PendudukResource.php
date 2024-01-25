<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Filament\Resources\PendudukResource\RelationManagers;
use App\Models\Agama;
use App\Models\HubunganDalamKeluarga;
use App\Models\JenisPekerjaan;
use App\Models\JenisPendidikan;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;
    protected static ?string $navigationLabel = 'Penduduk';
    protected static ?string $navigationGroup = 'Kependudukan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nokk')
                    ->label('Nomor Kartu Keluarga')
                    ->required()
                    ->maxLength(16),
                Forms\Components\TextInput::make('nik')
                    ->label('Nomor Induk Kependudukan (NIK)')
                    ->required()
                    ->maxLength(16),
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
                Select::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])->native(false),

                Forms\Components\TextInput::make('tempat_lahir')
                    ->maxLength(255),
                DatePicker::make('tanggal_lahir'),
                Select::make('hubungan_dalam_keluarga')->options(HubunganDalamKeluarga::all()
                    ->pluck('hubungan_dalam_keluarga', 'id'))
                    ->native(false),

                Select::make('agama')->options(Agama::all()
                    ->pluck('agama', 'id'))
                    ->native(false),
                Select::make('pendidikan')->options(JenisPendidikan::all()
                    ->pluck('jenis_pendidikan', 'id'))
                    ->native(false),
                Select::make('jenis_pekerjaan')->options(JenisPekerjaan::all()
                    ->pluck('jenis_pekerjaan', 'id'))
                    ->native(false),
                Select::make('golongan_darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                        'Tidak Ditahui' => 'Tidak Diketahui',
                    ])->native(false),
                Forms\Components\Textarea::make('alamat')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nokk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
