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
        // Retrieve counts for events, groups, and app users for this week
        $eventsThisWeekCount = Event::whereBetween('created_at', [now()->startOfWeek(), now()])->count();
        $groupsThisWeekCount = Group::whereBetween('created_at', [now()->startOfWeek(), now()])->count();
        $appUsersThisWeekCount = App::whereBetween('created_at', [now()->startOfWeek(), now()])->count();

        // Retrieve counts for events, groups, and app users for last week
        $eventsLastWeekCount = Event::whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->startOfWeek()])->count();
        $groupsLastWeekCount = Group::whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->startOfWeek()])->count();
        $appUsersLastWeekCount = App::whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->startOfWeek()])->count();

        // Calculate percentage changes
        $eventsPercentageChange = $eventsLastWeekCount > 0 ? (($eventsThisWeekCount - $eventsLastWeekCount) / $eventsLastWeekCount) * 100 : 0;
        $groupsPercentageChange = $groupsLastWeekCount > 0 ? (($groupsThisWeekCount - $groupsLastWeekCount) / $groupsLastWeekCount) * 100 : 0;
        $appUsersPercentageChange = $appUsersLastWeekCount > 0 ? (($appUsersThisWeekCount - $appUsersLastWeekCount) / $appUsersLastWeekCount) * 100 : 0;

        return [
            Stat::make('New users this week', $appUsersThisWeekCount)
                ->description($appUsersPercentageChange . '% ' . ($appUsersPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($appUsersPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($appUsersPercentageChange >= 0 ? 'success' : 'danger'),

            Stat::make('New events this week', $eventsThisWeekCount)
                ->description($eventsPercentageChange . '% ' . ($eventsPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($eventsPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($eventsPercentageChange >= 0 ? 'success' : 'danger'),

            Stat::make('New groups this week', $groupsThisWeekCount)
                ->description($groupsPercentageChange . '% ' . ($groupsPercentageChange >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($groupsPercentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($groupsPercentageChange >= 0 ? 'success' : 'danger'),
        ];
    }
}

