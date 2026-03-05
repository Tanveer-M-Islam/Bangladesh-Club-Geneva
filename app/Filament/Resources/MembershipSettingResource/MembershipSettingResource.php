<?php

namespace App\Filament\Resources\MembershipSettingResource;

use App\Filament\Resources\MembershipSettingResource\Pages\ManageMembershipSettings;
use App\Filament\Resources\MembershipSettingResource\Schemas\MembershipSettingForm;
use App\Models\MembershipSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class MembershipSettingResource extends Resource
{
    protected static ?string $model = MembershipSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';
    
    protected static ?int $navigationSort = 7;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Membership';
    
    protected static ?string $navigationLabel = 'Bank Details';
    
    protected static ?string $label = 'Bank Detail';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return MembershipSettingForm::configure($schema);
    }



    public static function getPages(): array
    {
        return [
            'index' => ManageMembershipSettings::route('/'),
        ];
    }
}
