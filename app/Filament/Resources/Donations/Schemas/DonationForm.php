<?php

namespace App\Filament\Resources\Donations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->prefix('CHF')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'received' => 'Received',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->native(false),
                FileUpload::make('payment_proof')
                    ->disk('public')
                    ->directory('donations')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }
}
