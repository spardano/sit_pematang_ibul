<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiResource\Pages;
use App\Models\Informasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\Toggle;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-s-information-circle';
    protected static ?string $navigationLabel = 'Informasi / Pengumuman';
    protected static ?string $navigationGroup = 'Informasi Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul_informasi')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('deskripsi')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('informasi')->label('Banner/Poster')
                    ->collection('informasi')
                    ->columnSpanFull(),
                Toggle::make('status_publish')
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
                SpatieMediaLibraryImageColumn::make('informasi')->collection('informasi'),
                Tables\Columns\TextColumn::make('judul_informasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_publish')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '0' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif'
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('deactivate')->label('matikan')->icon('heroicon-o-x-circle')->color('danger')->action(function ($data, $record): void {
                    self::deactivate($record, $data);
                })->requiresConfirmation()->visible(function ($record) {
                    return $record->status_publish == 1;
                }),

                Tables\Actions\Action::make('activate')->label('hidupkan')->icon('heroicon-o-check')->color('success')->action(function ($data, $record): void {
                    self::activate($record, $data);
                })->requiresConfirmation()->visible(function ($record) {
                    return $record->status_publish == 0;
                }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function deactivate($record, $data)
    {
        $record->status_publish = 0;
        $record->save();
    }

    public static function activate($record, $data)
    {
        $record->status_publish = 1;
        $record->save();
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
            'index' => Pages\ListInformasis::route('/'),
            'create' => Pages\CreateInformasi::route('/create'),
            'edit' => Pages\EditInformasi::route('/{record}/edit'),
        ];
    }
}
