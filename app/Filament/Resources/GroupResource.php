<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GroupResource extends Resource
{

    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Groups';

    protected static ?string $navigationGroup = 'Application';

    public static function getNavigationBadge(): string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                ->required(),
                Forms\Components\TextInput::make('admin_id')
                ->required(),
                Forms\Components\TextInput::make('group_id')
                ->required(),
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextInput::make('description')
                ->required(),
                Forms\Components\TextInput::make('group_image')
                ->required(),
                Forms\Components\TextInput::make('catagory')
                ->required(),
                Forms\Components\TextInput::make('location')
                ->required(),
                Forms\Components\TextInput::make('access_modifier')
                ->required(),
                Forms\Components\TextInput::make('members')
                ->required(),
                Forms\Components\TextInput::make('events')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->searchable(),
                Tables\Columns\ImageColumn::make('group_image')
                ->circular(),
                Tables\Columns\TextColumn::make('admin_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('group_id')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
                Tables\Columns\TextColumn::make('name')
                ->weight(FontWeight::Bold)
                ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->limit(50)
                ->searchable(),
                Tables\Columns\TextColumn::make('catagory')
                ->searchable(),
                Tables\Columns\TextColumn::make('location')
                ->icon('heroicon-m-map')
                ->searchable(),
                Tables\Columns\IconColumn::make('access_modifier')
                ->boolean(),
                Tables\Columns\TextColumn::make('members')
                ->searchable(),
                Tables\Columns\TextColumn::make('events')
                ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'view' => Pages\ViewGroup::route('/{record}'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
