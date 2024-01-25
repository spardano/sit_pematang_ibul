<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanLayananResource\Pages;
use App\Filament\Resources\PengajuanLayananResource\RelationManagers;
use App\Models\PengajuanLayanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanLayananResource extends Resource
{
    protected static ?string $model = PengajuanLayanan::class;
    protected static ?string $navigationLabel = 'Pengajuan';
    protected static ?string $navigationGroup = 'Pelayanan Desa';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Pengguna'),
                TextColumn::make('layanan_desa.nama_layanan')->label('Layanan'),
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'gray',
                        '1' => 'info',
                        '2' => 'success',
                        '3' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Pengajuan',
                        '1' => 'Sedang Di Proses',
                        '2' => 'Diterima',
                        '3' => 'Ditolak',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('detail')
                    ->color('info')
                    ->icon('heroicon-o-eye')
                    ->modalContent(
                        function ($record) {
                            $data['id'] = $record->id;
                            return view('modal.pengajuan-detail', $data);
                        }
                    )
                    ->modalSubmitAction(false),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPengajuanLayanans::route('/'),
            'create' => Pages\CreatePengajuanLayanan::route('/create'),
            'edit' => Pages\EditPengajuanLayanan::route('/{record}/edit'),
        ];
    }
}
