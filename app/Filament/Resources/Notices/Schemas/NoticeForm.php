<?php

namespace App\Filament\Resources\Notices\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class NoticeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'image' => 'Image',
                        'pdf' => 'PDF',
                    ])
                    ->default('text')
                    ->required()
                    ->live(),
                Textarea::make('content')
                    ->visible(fn (callable $get) => $get('type') === 'text')
                    ->columnSpanFull(),
                FileUpload::make('attachment')
                    ->disk('public')
                    ->directory('notices')
                    ->acceptedFileTypes(['image/*', 'application/pdf'])
                    ->visible(fn (callable $get) => in_array($get('type'), ['image', 'pdf']))
                    ->columnSpanFull(),
                DatePicker::make('expires_at')
                    ->required()
                    ->native(false),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
            ]);
    }
}
