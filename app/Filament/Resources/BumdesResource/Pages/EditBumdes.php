<?php

namespace App\Filament\Resources\BumdesResource\Pages;

use App\Filament\Resources\BumdesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBumdes extends EditRecord
{
    protected static string $resource = BumdesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
