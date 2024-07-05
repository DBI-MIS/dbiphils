<?php

namespace App\Filament\Resources\MainpageResource\Pages;

use App\Filament\Resources\MainpageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMainpages extends ListRecords
{
    protected static string $resource = MainpageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
