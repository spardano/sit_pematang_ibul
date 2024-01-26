<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FieldResource\Pages;
use App\Models\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FieldResource extends Resource
{
    protected static ?string $model = Field::class;
    protected static ?string $navigationLabel = 'Field';
    protected static ?string $navigationGroup = 'Pelayanan Desa';
    protected static ?string $navigationIcon = 'heroicon-s-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Field')
                    ->required()
                    ->minLength(2),
                Select::make('type')
                    ->label('Tipe Field')
                    ->options([
                        'number' => 'number',
                        'text' => 'text',
                        'date' => 'date',
                        'document' => 'document',
                        'select' => 'select',
                    ])
                    ->native(false),
                TagsInput::make('options')
                    ->placeholder('Masukkan options')
                    ->separator(',')
                    ->columnSpanFull(),

                TextInput::make('label')
                    ->label('Label')
                    ->minLength(5),
                TextInput::make('placeholder')
                    ->label('Placeholder')
                    ->minLength(5),
                TextInput::make('helper_text')
                    ->label('Text Bantu')
                    ->minLength(10)
                    ->columnSpanFull(),
                Toggle::make('required')
                    ->onIcon('heroicon-o-check')
                    ->onColor('success')
                    ->offIcon('heroicon-o-arrow-uturn-down')
                    ->offColor('gray')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
            'index' => Pages\ManageFields::route('/'),
        ];
    }
}
