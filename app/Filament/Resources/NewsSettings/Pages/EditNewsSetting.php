<?php

namespace App\Filament\Resources\NewsSettings\Pages;

use App\Filament\Resources\NewsSettings\NewsSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditNewsSetting extends EditRecord
{
    protected static string $resource = NewsSettingResource::class;

    public function getTitle(): string
    {
        return 'News Settings';
    }

    protected function getHeaderActions(): array
    {
        return [
            // No delete action for singleton
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index', ['record' => $this->record]);
    }
}
