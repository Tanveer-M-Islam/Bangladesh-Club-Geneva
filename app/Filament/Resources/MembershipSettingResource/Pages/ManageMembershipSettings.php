<?php

namespace App\Filament\Resources\MembershipSettingResource\Pages;

use App\Filament\Resources\MembershipSettingResource\MembershipSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class ManageMembershipSettings extends EditRecord
{
    protected static string $resource = MembershipSettingResource::class;

    public function mount(int | string $record = 1): void
    {
        $setting = \App\Models\MembershipSetting::firstOrCreate(['id' => 1]);
        parent::mount($setting->id);
    }

    protected function getActions(): array
    {
        return [];
    }
}
