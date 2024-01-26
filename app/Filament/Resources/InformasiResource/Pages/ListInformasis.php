<?php

namespace App\Filament\Resources\InformasiResource\Pages;

use App\Filament\Resources\InformasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInformasis extends ListRecords
{
    protected static string $resource = InformasiResource::class;
    protected static ?string $title = 'INFORMASI / PENGUMUMAN';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
