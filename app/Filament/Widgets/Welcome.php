<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Widget;

class Welcome extends Widget
{
    protected static string $view = 'filament.widgets.welcome';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'currentTime' => Carbon::now(),
            'user' => Auth()->user(),
        ];
    }
}
