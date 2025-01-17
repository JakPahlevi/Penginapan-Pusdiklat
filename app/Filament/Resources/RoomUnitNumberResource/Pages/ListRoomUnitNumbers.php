<?php

namespace App\Filament\Resources\RoomUnitNumberResource\Pages;

use App\Filament\Resources\RoomUnitNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomUnitNumbers extends ListRecords
{
    protected static string $resource = RoomUnitNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
