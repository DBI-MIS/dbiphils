<?php

namespace App\Filament\Resources\ProductResponseResource\Pages;

use App\Filament\Resources\ProductResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductResponses extends ListRecords
{
    protected static string $resource = ProductResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
