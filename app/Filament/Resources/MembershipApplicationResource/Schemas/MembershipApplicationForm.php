<?php

namespace App\Filament\Resources\MembershipApplicationResource\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class MembershipApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('contact_number')
                    ->required()
                    ->maxLength(255),
                Select::make('blood_group')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                    ])
                    ->required(),
                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('payment_proof')
                    ->label('Payment Proof')
                    ->disk('public')
                    ->directory('memberships/proofs')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('member_photo')
                    ->label('Member Photo')
                    ->disk('public')
                    ->directory('memberships/photos')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
