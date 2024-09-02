<?php

namespace App\Filament\Resources\JobResponseResource\Pages;

use App\Filament\Resources\JobResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobResponses extends ListRecords
{
    protected static string $resource = JobResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
