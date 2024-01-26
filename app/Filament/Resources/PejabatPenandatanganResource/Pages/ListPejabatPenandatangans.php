<?php

namespace App\Filament\Resources\PejabatPenandatanganResource\Pages;

use App\Filament\Resources\PejabatPenandatanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPejabatPenandatangans extends ListRecords
{
    protected static string $resource = PejabatPenandatanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
