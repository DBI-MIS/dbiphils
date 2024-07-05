<?php

namespace App\Filament\Resources\FeaturedProjectResource\Pages;

use App\Filament\Resources\FeaturedProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedProject extends CreateRecord
{
    protected static string $resource = FeaturedProjectResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
