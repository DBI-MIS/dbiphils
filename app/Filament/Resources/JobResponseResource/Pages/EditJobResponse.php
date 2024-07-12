<?php

namespace App\Filament\Resources\JobResponseResource\Pages;

use App\Filament\Resources\JobResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobResponse extends EditRecord
{
    protected static string $resource = JobResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
