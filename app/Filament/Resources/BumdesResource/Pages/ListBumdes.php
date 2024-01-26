<?php

namespace App\Filament\Resources\BumdesResource\Pages;

use App\Filament\Resources\BumdesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBumdes extends ListRecords
{
    protected static string $resource = BumdesResource::class;
    protected static ?string $title = 'BUMDES';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
