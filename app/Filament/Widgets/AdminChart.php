<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\ChartWidget;

class AdminChart extends ChartWidget
{
    protected static ?string $heading = 'Events creation';

    protected function getData(): array
    {
        // Initialize an array to hold the count of events created in each month
        $eventCounts = [];

        // Retrieve the count of events created in each month
        for ($month = 1; $month <= 12; $month++) {
            $eventCounts[] = Event::whereMonth('created_at', $month)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Events created',
                    'data' => $eventCounts,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}
