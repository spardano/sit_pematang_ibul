<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenduduks extends ListRecords
{
    protected static string $resource = PendudukResource::class;
    protected static ?string $title = 'PENDUDUK DESA';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
