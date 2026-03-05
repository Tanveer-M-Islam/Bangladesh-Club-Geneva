<?php

namespace App\Filament\Resources\FooterSettingResource;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;
    
    protected static ?int $navigationSort = 11;

    protected static ?string $navigationLabel = 'Footer Settings';

    protected static ?string $label = 'Footer Setting';

    protected static ?string $pluralLabel = 'Footer Settings';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->description('Set the footer description and copyright text.')
                    ->schema([
                        Textarea::make('footer_info')
                            ->label('Footer Information')
                            ->placeholder('Brief description of the club...')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('copyright_text')
                            ->label('Copyright Text')
                            ->placeholder('e.g., Copyright © 2026 Bangladesh Club Geneva')
                            ->required(),
                    ]),
                Section::make('Social Media Links')
                    ->description('Provide URLs for your social media profiles.')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->placeholder('https://facebook.com/...'),
                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->url()
                            ->placeholder('https://twitter.com/...'),
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->placeholder('https://instagram.com/...'),
                        TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->url()
                            ->placeholder('https://youtube.com/...'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('copyright_text')
                    ->limit(50),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooterSettings::route('/'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }
}
