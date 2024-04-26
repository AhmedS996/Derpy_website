<?php

namespace App\Filament\Widgets;

use App\Models\App;
use Filament\Widgets\ChartWidget;

class AUserChart extends ChartWidget
{
    protected static ?string $heading = 'New User Registration';

    protected function getData(): array
    {
        // Initialize an array to hold the count of new users registered in each month
        $userCounts = [];

        // Retrieve the count of new users registered in each month
        for ($month = 1; $month <= 12; $month++) {
            $userCounts[] = App::whereMonth('created_at', $month)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Users',
                    'data' => $userCounts,
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#8BC34A',
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
