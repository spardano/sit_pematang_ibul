<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PejabatPenandatanganResource\Pages;
use App\Models\PejabatPenandatangan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Saade\FilamentAutograph\Forms\Components\Enums\DownloadableFormat;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class PejabatPenandatanganResource extends Resource
{
    protected static ?string $model = PejabatPenandatangan::class;
    protected static ?string $navigationLabel = 'Pejabat Penandatangan';
    protected static ?string $navigationGroup = 'Pelayanan Desa';
    protected static ?string $navigationIcon = 'heroicon-s-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pejabat')
                    ->required()
                    ->maxLength(255),
                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])->native(false),
                Forms\Components\TextInput::make('nip')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->maxLength(255),
                Forms\Components\TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                SignaturePad::make('generate_ttd')
                    ->label(__('Buat Tanda Tangan Disini'))
                    ->dotSize(2.0)
                    ->downloadable()
                    ->exportPenColor('#000')                  // Allow download of the signature (defaults to false)
                    ->downloadableFormats([             // Available formats for download (defaults to all)
                        DownloadableFormat::PNG,
                    ]),
                SpatieMediaLibraryFileUpload::make('signature')
                    ->label('Upload Tanda Tangan')
                    ->required()
                    ->collection('signature')
                    ->columnSpanFull()
                    ->helperText('Upload gambar tanda tangan yang telah anda download dalam bentuk PNG')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pejabat')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('signature')->collection('signature'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPejabatPenandatangans::route('/'),
            'create' => Pages\CreatePejabatPenandatangan::route('/create'),
            'edit' => Pages\EditPejabatPenandatangan::route('/{record}/edit'),
        ];
    }
}
