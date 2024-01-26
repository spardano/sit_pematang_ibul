<?php

namespace App\Filament\Resources\JenisPendidikanResource\Pages;

use App\Filament\Resources\JenisPendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisPendidikans extends ManageRecords
{
    protected static string $resource = JenisPendidikanResource::class;
    protected static ?string $title = 'PENDIDIKAN';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
