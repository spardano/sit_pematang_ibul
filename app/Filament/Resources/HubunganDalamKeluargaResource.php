<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HubunganDalamKeluargaResource\Pages;
use App\Models\HubunganDalamKeluarga;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HubunganDalamKeluargaResource extends Resource
{
    protected static ?string $model = HubunganDalamKeluarga::class;

    protected static ?string $navigationLabel = 'Hubungan Dalam Keluarga';
    protected static ?string $navigationGroup = 'Kependudukan';
    protected static ?string $navigationIcon = 'eos-hub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('hubungan_dalam_keluarga')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hubungan_dalam_keluarga')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageHubunganDalamKeluargas::route('/'),
        ];
    }
}
