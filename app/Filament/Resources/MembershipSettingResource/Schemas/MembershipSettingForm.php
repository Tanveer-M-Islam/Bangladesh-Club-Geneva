<?php

namespace App\Filament\Resources\MembershipSettingResource\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;

class MembershipSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('bank_name')
                    ->label('Bank Name')
                    ->default(null),
                \Filament\Forms\Components\TextInput::make('bank_iban')
                    ->label('Bank IBAN')
                    ->default(null),
                \Filament\Forms\Components\TextInput::make('bank_account_name')
                    ->label('Bank Account Name')
                    ->default(null),
                \Filament\Forms\Components\FileUpload::make('qr_code_path')
                    ->label('Payment QR Code Image')
                    ->image()
                    ->directory('memberships')
                    ->disk('public')
                    ->visibility('public'),
                \Filament\Forms\Components\Textarea::make('payment_note')
                    ->label('Payment Note')
                    ->default('Please upload a screenshot or photo of your payment confirmation using the form on the right.')
                    ->columnSpanFull(),
            ]);
    }
}
