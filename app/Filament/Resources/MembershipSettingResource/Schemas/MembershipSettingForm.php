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
                RichEditor::make('payment_details')
                    ->label('Bank & Payment Details')
                    ->helperText('This information will appear on the left side of the registration form.')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
