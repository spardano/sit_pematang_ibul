<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananDesaResource\Pages;
use App\Filament\Resources\LayananDesaResource\RelationManagers\FieldRelationManager;
use App\Models\LayananDesa;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LayananDesaResource extends Resource
{
    protected static ?string $model = LayananDesa::class;
    protected static ?string $navigationLabel = 'Layanan Desa';
    protected static ?string $navigationGroup = 'Pelayanan Desa';
    protected static ?string $navigationIcon = 'heroicon-m-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_layanan')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->maxLength(255),
                TextInput::make('slug'),
                Forms\Components\TextInput::make('icon')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            FieldRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayananDesas::route('/'),
            'create' => Pages\CreateLayananDesa::route('/create'),
            'edit' => Pages\EditLayananDesa::route('/{record}/edit'),
        ];
    }
}
