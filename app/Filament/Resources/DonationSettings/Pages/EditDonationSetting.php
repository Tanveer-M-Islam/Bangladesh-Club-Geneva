<?php

namespace App\Filament\Resources\DonationSettings\Pages;

use App\Filament\Resources\DonationSettings\DonationSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDonationSetting extends EditRecord
{
    protected static string $resource = DonationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
