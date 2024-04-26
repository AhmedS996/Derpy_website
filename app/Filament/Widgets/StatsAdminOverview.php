<?php

namespace App\Filament\Widgets;

use App\Models\App;
use App\Models\Event;
use App\Models\Group;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Retrieve counts and creation dates for events, groups, and app users
        $eventsCount = Event::count();
        $groupsCount = Group::count();
        $appUsersCount = App::count();

        // Calculate statistics based on creation dates
        $eventsLastWeekCount = Event::where('created_at', '>=', now()->subWeek())->count();
        $groupsLastWeekCount = Group::where('created_at', '>=', now()->subWeek())->count();
        $appUsersLastWeekCount = App::where('created_at', '>=', now()->subWeek())->count();

        // Calculate percentage changes
        $eventsPercentageChange = $eventsLastWeekCount > 0 ? (($eventsLastWeekCount - $eventsCount) / $eventsLastWeekCount) * 100 : 0;
        $groupsPercentageChange = $groupsLastWeekCount > 0 ? (($groupsLastWeekCount - $groupsCount) / $groupsLastWeekCount) * 100 : 0;
        $appUsersPercentageChange = $appUsersLastWeekCount > 0 ? (($appUsersLastWeekCount - $appUsersCount) / $appUsersLastWeekCount) * 100 : 0;

        return [
            Stat::make('New users last week', $appUsersLastWeekCount)
                ->description($appUsersPercentageChange . '% ' . ($appUsersPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($appUsersPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($appUsersPercentageChange >= 0 ? 'success' : 'danger'),

            Stat::make('New events last week', $eventsLastWeekCount)
                ->description($eventsPercentageChange . '% ' . ($eventsPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($eventsPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($eventsPercentageChange >= 0 ? 'success' : 'danger'),

            Stat::make('New groups last week', $groupsLastWeekCount)
                ->description($groupsPercentageChange . '% ' . ($groupsPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($groupsPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($groupsPercentageChange >= 0 ? 'success' : 'danger'),


        ];

    }
}
