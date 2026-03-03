<?php

namespace App\Filament\Resources\NewsSettings\Pages;

use App\Filament\Resources\NewsSettings\NewsSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsSetting extends CreateRecord
{
    protected static string $resource = NewsSettingResource::class;
}
