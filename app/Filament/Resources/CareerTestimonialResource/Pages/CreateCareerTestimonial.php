<?php

namespace App\Filament\Resources\CareerTestimonialResource\Pages;

use App\Filament\Resources\CareerTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCareerTestimonial extends CreateRecord
{
    protected static string $resource = CareerTestimonialResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
