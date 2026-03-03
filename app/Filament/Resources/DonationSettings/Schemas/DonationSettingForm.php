<?php

namespace App\Filament\Resources\DonationSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DonationSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bank_name')
                    ->default(null),
                TextInput::make('bank_iban')
                    ->default(null),
                TextInput::make('bank_account_name')
                    ->default(null),
                TextInput::make('twint_number')
                    ->default(null),
                Textarea::make('donation_note')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
