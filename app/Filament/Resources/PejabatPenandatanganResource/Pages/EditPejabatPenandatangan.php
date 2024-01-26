<?php

namespace App\Filament\Resources\PejabatPenandatanganResource\Pages;

use App\Filament\Resources\PejabatPenandatanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPejabatPenandatangan extends EditRecord
{
    protected static string $resource = PejabatPenandatanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
