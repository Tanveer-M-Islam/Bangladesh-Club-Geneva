<?php

namespace App\Filament\Resources\ContactSettings;

use App\Filament\Resources\ContactSettings\Pages\EditContactSetting;
use App\Filament\Resources\ContactSettings\Pages\ListContactSettings;
use App\Filament\Resources\ContactSettings\Schemas\ContactSettingForm;
use App\Models\ContactSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

class ContactSettingResource extends Resource
{
    protected static ?string $model = ContactSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Contact Settings';

    protected static ?string $pluralLabel = 'Contact Settings';

    protected static ?string $label = 'Contact Setting';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return ContactSettingForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactSettings::route('/'),
            'edit' => EditContactSetting::route('/{record}/edit'),
        ];
    }
}
