<?php

namespace App\Filament\Resources\MembershipSettingResource\Pages;

use App\Filament\Resources\MembershipSettingResource\MembershipSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMembershipSettings extends ManageRecords
{
    protected static string $resource = MembershipSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
