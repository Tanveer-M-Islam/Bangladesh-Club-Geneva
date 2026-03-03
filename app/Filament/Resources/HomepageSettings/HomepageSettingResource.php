<?php

namespace App\Filament\Resources\HomepageSettings;

use App\Filament\Resources\HomepageSettings\Pages\EditHomepageSetting;
use App\Filament\Resources\HomepageSettings\Pages\ListHomepageSettings;
use App\Filament\Resources\HomepageSettings\Schemas\HomepageSettingForm;
use App\Filament\Resources\HomepageSettings\Tables\HomepageSettingsTable;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomepageSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationLabel = 'Homepage Settings';

    protected static ?string $pluralLabel = 'Homepage Settings';

    protected static ?string $label = 'Homepage Setting';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return HomepageSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomepageSettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomepageSettings::route('/'),
            // Skip create because we usually only have one record for site settings
            'edit' => EditHomepageSetting::route('/{record}/edit'),
        ];
    }
}
