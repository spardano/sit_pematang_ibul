<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPekerjaanResource\Pages;
use App\Models\JenisPekerjaan;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JenisPekerjaanResource extends Resource
{
    protected static ?string $model = JenisPekerjaan::class;

    protected static ?string $navigationLabel = 'Jenis Pekerjaan';
    protected static ?string $navigationGroup = 'Kependudukan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jenis_pekerjaan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_pekerjaan')
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
            'index' => Pages\ManageJenisPekerjaans::route('/'),
        ];
    }
}
