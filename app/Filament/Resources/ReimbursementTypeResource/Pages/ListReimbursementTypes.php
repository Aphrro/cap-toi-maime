<?php

namespace App\Filament\Resources\ReimbursementTypeResource\Pages;

use App\Filament\Resources\ReimbursementTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReimbursementTypes extends ListRecords
{
    protected static string $resource = ReimbursementTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
