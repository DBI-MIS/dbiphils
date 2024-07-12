<?php

namespace App\Filament\Resources\ProductResponseResource\Pages;

use App\Filament\Resources\ProductResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductResponse extends EditRecord
{
    protected static string $resource = ProductResponseResource::class;

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
