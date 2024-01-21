<?php

namespace App\Filament\Resources\HubunganDalamKeluargaResource\Pages;

use App\Filament\Resources\HubunganDalamKeluargaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHubunganDalamKeluargas extends ManageRecords
{
    protected static string $resource = HubunganDalamKeluargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
