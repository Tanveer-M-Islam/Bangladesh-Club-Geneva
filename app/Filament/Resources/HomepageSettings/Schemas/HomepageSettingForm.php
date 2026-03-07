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
                        FileUpload::make('ad1_path')->label('Ad Slot 1')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad2_path')->label('Ad Slot 2')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad3_path')->label('Ad Slot 3')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad4_path')->label('Ad Slot 4')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad5_path')->label('Ad Slot 5')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad6_path')->label('Ad Slot 6')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad7_path')->label('Ad Slot 7')->image()->directory('ads')->disk('public')->visibility('public'),
                        FileUpload::make('ad8_path')->label('Ad Slot 8')->image()->directory('ads')->disk('public')->visibility('public'),
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
