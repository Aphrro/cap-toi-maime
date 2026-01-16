<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\Widget;

class UpcomingEvents extends Widget
{
    protected static ?int $sort = 4;
    protected static string $view = 'filament.widgets.upcoming-events';
    protected int | string | array $columnSpan = 1;

    public function getEvents()
    {
        return Event::query()
            ->upcoming()
            ->published()
            ->orderBy('start_date')
            ->limit(3)
            ->get();
    }
}
