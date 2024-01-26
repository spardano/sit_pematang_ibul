<?php

namespace App\Filament\Resources\PengajuanLayananResource\Pages;

use App\Filament\Resources\PengajuanLayananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanLayanans extends ListRecords
{
    protected static string $resource = PengajuanLayananResource::class;
    protected static ?string $title = 'PENGAJUAN LAYANAN';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
