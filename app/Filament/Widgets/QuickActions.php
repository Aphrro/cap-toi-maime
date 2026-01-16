<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static ?int $sort = 5;
    protected static string $view = 'filament.widgets.quick-actions';
    protected int | string | array $columnSpan = 1;
}
