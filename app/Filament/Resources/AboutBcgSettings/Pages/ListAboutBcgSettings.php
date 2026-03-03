<?php

namespace App\Filament\Resources\AboutBcgSettings\Pages;

use App\Filament\Resources\AboutBcgSettings\AboutBcgSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListAboutBcgSettings extends ListRecords
{
    protected static string $resource = AboutBcgSettingResource::class;

    public function mount(): void
    {
        $record = \App\Models\AboutBcgSetting::first();

        if (! $record) {
            $record = \App\Models\AboutBcgSetting::create([
                'president_name' => 'President Name',
                'president_speech' => 'Presidential Speech Content',
            ]);
        }

        $this->redirect(AboutBcgSettingResource::getUrl('edit', ['record' => $record]));
    }
}
