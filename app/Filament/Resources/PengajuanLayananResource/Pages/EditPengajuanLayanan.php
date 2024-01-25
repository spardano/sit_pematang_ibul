<?php

namespace App\Filament\Resources\PengajuanLayananResource\Pages;

use App\Filament\Resources\PengajuanLayananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanLayanan extends EditRecord
{
    protected static string $resource = PengajuanLayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
