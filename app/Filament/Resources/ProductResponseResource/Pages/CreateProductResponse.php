<?php

namespace App\Filament\Resources\ProductResponseResource\Pages;

use App\Filament\Resources\ProductResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductResponse extends CreateRecord
{
    protected static string $resource = ProductResponseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
