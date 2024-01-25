<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationLabel = 'Event / Kegiatan';
    protected static ?string $navigationGroup = 'Informasi Publik';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul_event')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sub_judul_event')
                    ->maxLength(255)
                    ->columnSpanFull(),
                RichEditor::make('deskripsi')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('event')->label('Banner/Poster')
                    ->collection('event')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('mulai')
                    ->required(),
                Forms\Components\DateTimePicker::make('selesai')
                    ->required(),
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
                SpatieMediaLibraryImageColumn::make('event')->collection('event'),
                Tables\Columns\TextColumn::make('judul_event')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mulai')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('selesai')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
