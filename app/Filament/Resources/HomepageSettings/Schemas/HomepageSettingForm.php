<?php

namespace App\Filament\Resources\HomepageSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HomepageSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Section')
                    ->description('Manage the main banner title, logo, and background slider.')
                    ->schema([
                        RichEditor::make('hero_title')
                            ->label('Hero Title')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('hero_logo_path')
                            ->label('Hero Side Image / Logo')
                            ->image()
                            ->directory('homepage')
                            ->disk('public')
                            ->visibility('public'),
                        FileUpload::make('hero_slider_images')
                            ->label('Background Slider Images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('homepage/slider')
                            ->disk('public')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Intro Section')
                    ->description('Manage the introduction image and text.')
                    ->schema([
                        RichEditor::make('introduction')
                            ->label('Introduction Text')
                            ->columnSpanFull(),
                        FileUpload::make('intro_image_path')
                            ->label('Introduction Image')
                            ->image()
                            ->directory('homepage')
                            ->disk('public')
                            ->visibility('public'),
                    ]),

                Section::make('Advertisements')
                    ->description('Manage the four advertisement slots on the homepage.')
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Ad Slot 1')->schema([
                            FileUpload::make('ad1_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad1_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 2')->schema([
                            FileUpload::make('ad2_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad2_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 3')->schema([
                            FileUpload::make('ad3_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad3_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 4')->schema([
                            FileUpload::make('ad4_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad4_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 5')->schema([
                            FileUpload::make('ad5_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad5_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 6')->schema([
                            FileUpload::make('ad6_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad6_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 7')->schema([
                            FileUpload::make('ad7_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad7_url')->label('URL')->url(),
                        ])->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Ad Slot 8')->schema([
                            FileUpload::make('ad8_path')->label('Image')->image()->directory('ads')->disk('public')->visibility('public'),
                            TextInput::make('ad8_url')->label('URL')->url(),
                        ])->columnSpan(1),
                    ])->columns(2),

                Section::make('Global Assets')
                    ->description('Manage common assets like the navbar logo.')
                    ->schema([
                        FileUpload::make('navbar_logo_path')
                            ->label('Navbar Logo')
                            ->image()
                            ->directory('site')
                            ->disk('public')
                            ->visibility('public'),
                    ]),
            ]);
    }
}
