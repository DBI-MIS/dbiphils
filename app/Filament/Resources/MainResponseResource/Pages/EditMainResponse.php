<?php

namespace App\Filament\Resources\MainResponseResource\Pages;

use App\Filament\Resources\MainResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainResponse extends EditRecord
{
    protected static string $resource = MainResponseResource::class;

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
