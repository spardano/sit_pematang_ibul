<?php

namespace App\Filament\Resources\LayananDesaResource\Pages;

use App\Filament\Resources\LayananDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananDesas extends ListRecords
{
    protected static string $resource = LayananDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
