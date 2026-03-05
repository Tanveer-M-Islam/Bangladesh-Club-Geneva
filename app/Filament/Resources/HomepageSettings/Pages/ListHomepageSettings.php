<?php

namespace App\Filament\Resources\HomepageSettings\Pages;

use App\Filament\Resources\HomepageSettings\HomepageSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\EditRecord;

class ListHomepageSettings extends EditRecord
{
    protected static string $resource = HomepageSettingResource::class;

    public function mount(int | string $record = 1): void
    {
        $setting = \App\Models\SiteSetting::firstOrCreate(['id' => 1]);
        parent::mount($setting->id);
    }

    protected function getActions(): array
    {
        return [];
    }
}
