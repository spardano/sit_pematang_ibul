<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BumdesResource\Pages;
use App\Models\Bumdes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class BumdesResource extends Resource
{
    protected static ?string $model = Bumdes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'BUMDES';
    protected static ?string $navigationGroup = 'Informasi Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_usaha')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jenis_usaha')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pengelola')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TimePicker::make('buka')
                    ->required(),
                Forms\Components\TimePicker::make('tutup')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('bumdes')->label('Banner/Poster')
                    ->collection('bumdes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('bumdes')->collection('bumdes'),
                Tables\Columns\TextColumn::make('nama_usaha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_usaha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pengelola')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buka')
                    ->Time()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tutup')
                    ->Time()
                    ->sortable(),
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
            'index' => Pages\ListBumdes::route('/'),
            'create' => Pages\CreateBumdes::route('/create'),
            'edit' => Pages\EditBumdes::route('/{record}/edit'),
        ];
    }
}
