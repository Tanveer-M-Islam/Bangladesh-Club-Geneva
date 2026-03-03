<?php

namespace App\Filament\Resources\DonationSettings\Pages;

use App\Filament\Resources\DonationSettings\DonationSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonationSettings extends ListRecords
{
    protected static string $resource = DonationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
