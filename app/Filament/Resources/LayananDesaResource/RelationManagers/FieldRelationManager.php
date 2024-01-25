<?php

namespace App\Filament\Resources\LayananDesaResource\RelationManagers;

use App\Models\Field;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FieldRelationManager extends RelationManager
{
    protected static string $relationship = 'field';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_field')->label('field')->options(Field::all()
                    ->pluck('name', 'id'))
                    ->searchable()
                    ->native(false)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id_layanan_desa')
            ->columns([
                Tables\Columns\TextColumn::make('field.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                DownStepAction::make(),
                UpStepAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');;
    }
}
