<?php

namespace App\Filament\Resources\MembershipApplicationResource;

use App\Filament\Resources\MembershipApplicationResource\Pages\CreateMembershipApplication;
use App\Filament\Resources\MembershipApplicationResource\Pages\EditMembershipApplication;
use App\Filament\Resources\MembershipApplicationResource\Pages\ListMembershipApplications;
use App\Filament\Resources\MembershipApplicationResource\Schemas\MembershipApplicationForm;
use App\Filament\Resources\MembershipApplicationResource\Tables\MembershipApplicationsTable;
use App\Models\MembershipApplication;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MembershipApplicationResource extends Resource
{
    protected static ?string $model = MembershipApplication::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Membership';
    
    protected static ?string $navigationLabel = 'Applications';

    public static function form(Schema $schema): Schema
    {
        return MembershipApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MembershipApplicationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMembershipApplications::route('/'),
            'create' => CreateMembershipApplication::route('/create'),
            'edit' => EditMembershipApplication::route('/{record}/edit'),
        ];
    }
}
