<?php

namespace App\Filament\Resources\CareerTestimonialResource\Pages;

use App\Filament\Resources\CareerTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareerTestimonials extends ListRecords
{
    protected static string $resource = CareerTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
