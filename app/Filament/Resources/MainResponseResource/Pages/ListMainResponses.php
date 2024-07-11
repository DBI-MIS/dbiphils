<?php

namespace App\Filament\Resources\MainResponseResource\Pages;

use App\Filament\Resources\MainResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMainResponses extends ListRecords
{
    protected static string $resource = MainResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
