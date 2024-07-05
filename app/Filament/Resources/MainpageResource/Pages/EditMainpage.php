<?php

namespace App\Filament\Resources\MainpageResource\Pages;

use App\Filament\Resources\MainpageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainpage extends EditRecord
{
    protected static string $resource = MainpageResource::class;

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
