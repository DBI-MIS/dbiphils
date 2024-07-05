<?php

namespace App\Filament\Resources\MainpageResource\Pages;

use App\Filament\Resources\MainpageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMainpage extends CreateRecord
{
    protected static string $resource = MainpageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
