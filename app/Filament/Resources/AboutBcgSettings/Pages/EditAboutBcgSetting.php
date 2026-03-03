<?php

namespace App\Filament\Resources\AboutBcgSettings\Pages;

use App\Filament\Resources\AboutBcgSettings\AboutBcgSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditAboutBcgSetting extends EditRecord
{
    protected static string $resource = AboutBcgSettingResource::class;

    public function getTitle(): string
    {
        return 'About BCG Settings';
    }

    protected function getHeaderActions(): array
    {
        return [
            // No actions for a singular settings page
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index', ['record' => $this->record]);
    }
}
