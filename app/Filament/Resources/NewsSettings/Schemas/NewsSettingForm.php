<?php

namespace App\Filament\Resources\NewsSettings\Schemas;

use Filament\Schemas\Schema;

class NewsSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Removed Page Header section to keep it static on frontend

                \Filament\Schemas\Components\Section::make('News Items')
                    ->description('Add URLs and details for news articles.')
                    ->icon('heroicon-o-newspaper')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('news_items')
                            ->label('News Articles')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('url')
                                    ->label('Article / Post URL')
                                    ->url()
                                    ->required()
                                    ->placeholder('https://facebook.com/...')
                                    ->columnSpanFull(),
                                \Filament\Forms\Components\DatePicker::make('published_date')
                                    ->label('Published Date')
                                    ->default(now())
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['url'] ?? null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
