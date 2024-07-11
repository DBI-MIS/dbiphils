<?php

namespace App\Filament\Resources\MainResponseResource\Pages;

use App\Filament\Resources\MainResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMainResponse extends CreateRecord
{
    protected static string $resource = MainResponseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
