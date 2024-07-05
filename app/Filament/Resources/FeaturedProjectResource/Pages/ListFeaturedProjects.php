<?php

namespace App\Filament\Resources\FeaturedProjectResource\Pages;

use App\Filament\Resources\FeaturedProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedProjects extends ListRecords
{
    protected static string $resource = FeaturedProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
