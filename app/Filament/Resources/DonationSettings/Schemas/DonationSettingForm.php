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
                \Filament\Forms\Components\FileUpload::make('twint_qr_code_path')
                    ->label('QR Code Image')
                    ->image()
                    ->directory('donations')
                    ->disk('public')
                    ->visibility('public'),
                Textarea::make('donation_note')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
