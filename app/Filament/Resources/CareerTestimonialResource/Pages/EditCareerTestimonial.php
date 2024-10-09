<?php

namespace App\Filament\Resources\CareerTestimonialResource\Pages;

use App\Filament\Resources\CareerTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerTestimonial extends EditRecord
{
    protected static string $resource = CareerTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
