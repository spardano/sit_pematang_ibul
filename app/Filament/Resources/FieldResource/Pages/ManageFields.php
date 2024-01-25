<?php

namespace App\Filament\Resources\FieldResource\Pages;

use App\Filament\Resources\FieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFields extends ManageRecords
{
    protected static string $resource = FieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['options'] = json_encode($data['options']);
    //     return $data;
    // }
}
