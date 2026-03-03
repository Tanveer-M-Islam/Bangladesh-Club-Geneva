<?php

namespace App\Filament\Resources\NewsSettings;

use App\Filament\Resources\NewsSettings\Pages\CreateNewsSetting;
use App\Filament\Resources\NewsSettings\Pages\EditNewsSetting;
use App\Filament\Resources\NewsSettings\Pages\ListNewsSettings;
use App\Filament\Resources\NewsSettings\Schemas\NewsSettingForm;
use App\Filament\Resources\NewsSettings\Tables\NewsSettingsTable;
use App\Models\NewsSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NewsSettingResource extends Resource
{
    protected static ?string $model = NewsSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'page_title';

    public static function form(Schema $schema): Schema
    {
        return NewsSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsSettings::route('/'),
            'create' => CreateNewsSetting::route('/create'),
            'edit' => EditNewsSetting::route('/{record}/edit'),
        ];
    }
}
