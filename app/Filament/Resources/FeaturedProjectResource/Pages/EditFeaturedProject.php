<?php

namespace App\Filament\Resources\FeaturedProjectResource\Pages;

use App\Filament\Resources\FeaturedProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedProject extends EditRecord
{
    protected static string $resource = FeaturedProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
