<?php

namespace App\Filament\Resources\DonationSettings;

use App\Filament\Resources\DonationSettings\Pages\CreateDonationSetting;
use App\Filament\Resources\DonationSettings\Pages\EditDonationSetting;
use App\Filament\Resources\DonationSettings\Pages\ListDonationSettings;
use App\Filament\Resources\DonationSettings\Schemas\DonationSettingForm;
use App\Filament\Resources\DonationSettings\Tables\DonationSettingsTable;
use App\Models\DonationSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DonationSettingResource extends Resource
{
    protected static ?string $model = DonationSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'bank_name';

    public static function form(Schema $schema): Schema
    {
        return DonationSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonationSettingsTable::configure($table);
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
            'index' => ListDonationSettings::route('/'),
            'create' => CreateDonationSetting::route('/create'),
            'edit' => EditDonationSetting::route('/{record}/edit'),
        ];
    }
}
