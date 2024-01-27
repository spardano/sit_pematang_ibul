<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanLayananResource\Pages;
use App\Models\PejabatPenandatangan;
use App\Models\PengajuanLayanan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengajuanLayananResource extends Resource
{
    protected static ?string $model = PengajuanLayanan::class;
    protected static ?string $navigationLabel = 'Pengajuan';
    protected static ?string $navigationGroup = 'Pelayanan Desa';
    protected static ?string $navigationIcon = 'heroicon-m-archive-box-arrow-down';

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
                Tables\Actions\Action::make('download_surat')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->color('success')
                    ->url(fn (PengajuanLayanan $record) => route('pengajuan_layanan.download.pdf', ['pengajuan' => $record]))
                    ->openUrlInNewTab()
                    ->visible(function ($record) {
                        return $record->status_pengajuan == 2;
                    }),

                Tables\Actions\Action::make('setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function ($data, $record): void {
                        self::approved($record, $data);
                    })->form([
                        TextInput::make('nomor_surat')->label('Nomor Surat'),
                        Select::make('id_pejabat')
                            ->label('Pilih Pejabat Penandatangan')
                            ->options(PejabatPenandatangan::all()->pluck('nama_pejabat', 'id'))
                            ->native(false)
                    ])->visible(function ($record) {
                        return $record->status_pengajuan == 1;
                    }),
                Tables\Actions\Action::make('tolak')->icon('heroicon-o-x-circle')->color('danger')->action(function ($data, $record): void {
                    self::rejected($record, $data);
                })->form([
                    Textarea::make('alasan_penolakan')->label('Alasan Penolakan')->required(),
                ])->visible(function ($record) {
                    return $record->status_pengajuan == 1;
                }),

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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function approved($record, $data)
    {
        $record->status_pengajuan = 2;
        $record->nomor_surat = $data['nomor_surat'];
        $record->id_pejabat = $data['id_pejabat'];
        $record->save();
    }

    public static function rejected($record, $data)
    {
        $record->alasan_penolakan = $data['alasan_penolakan'];
        $record->status_pengajuan = 3;
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
            'index' => Pages\ListPengajuanLayanans::route('/'),
            'create' => Pages\CreatePengajuanLayanan::route('/create'),
            'edit' => Pages\EditPengajuanLayanan::route('/{record}/edit'),
        ];
    }
}
