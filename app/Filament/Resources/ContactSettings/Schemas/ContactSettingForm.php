<?php

namespace App\Filament\Resources\ContactSettings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;

class ContactSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Organization Details')
                    ->description('Manage the organization name and registration number.')
                    ->schema([
                        TextInput::make('organization_name')
                            ->label('Organization Name')
                            ->required(),
                        TextInput::make('registration_no')
                            ->label('Registration Number'),
                    ])->columns(2),

                Section::make('Contact Information')
                    ->description('Manage phone numbers, emails, and address.')
                    ->schema([
                        TagsInput::make('phones')
                            ->label('Phone Numbers')
                            ->placeholder('Type a number and hit enter')
                            ->separator(','),
                        TagsInput::make('emails')
                            ->label('Emails')
                            ->placeholder('Type an email and hit enter')
                            ->separator(','),
                        Textarea::make('location')
                            ->label('Location / Address')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
