<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPendidikanResource\Pages;
use App\Filament\Resources\JenisPendidikanResource\RelationManagers;
use App\Models\JenisPendidikan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisPendidikanResource extends Resource
{
    protected static ?string $model = JenisPendidikan::class;

    protected static ?string $navigationLabel = 'Jenis Pendidikan';
    protected static ?string $navigationGroup = 'Kependudukan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jenis_pendidikan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_pendidikan')
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
            'index' => Pages\ManageJenisPendidikans::route('/'),
        ];
    }
}
