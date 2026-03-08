<?php

namespace App\Filament\Resources\ContactSettings\Pages;

use App\Filament\Resources\ContactSettings\ContactSettingResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class ListContactSettings extends EditRecord
{
    protected static string $resource = ContactSettingResource::class;

    public function mount(int | string $record = 1): void
    {
        $setting = \App\Models\ContactSetting::firstOrCreate(['id' => 1]);
        parent::mount($setting->id);
    }

    protected function getActions(): array
    {
        return [];
    }
}
