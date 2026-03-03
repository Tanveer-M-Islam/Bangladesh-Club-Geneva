<?php

namespace App\Filament\Resources\NewsSettings\Pages;

use App\Filament\Resources\NewsSettings\NewsSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListNewsSettings extends ListRecords
{
    protected static string $resource = NewsSettingResource::class;

    public function mount(): void
    {
        $record = \App\Models\NewsSetting::first();

        if (! $record) {
            $record = \App\Models\NewsSetting::create([
                'page_title' => 'News & Updates',
                'news_items' => [],
            ]);
        }

        $this->redirect(NewsSettingResource::getUrl('edit', ['record' => $record]));
    }
}
