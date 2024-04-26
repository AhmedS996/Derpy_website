<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
        {
            return
            [
                'All' => Tab::make(),
                'This Week' => Tab::make()
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                    ->badge(Event::query()->where('created_at', '>=', now()->subWeek())->count()),
                'This Month' => Tab::make()
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                    ->badge(Event::query()->where('created_at', '>=', now()->subMonth())->count()),
                'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Event::query()->where('created_at', '>=', now()->subYear())->count()),
            ];
    }
}
