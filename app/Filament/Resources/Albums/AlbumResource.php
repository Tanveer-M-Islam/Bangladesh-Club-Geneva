<?php

namespace App\Filament\Resources\Albums;

use App\Filament\Resources\Albums\Pages\ManageAlbums;
use App\Models\Album;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Photo Gallery Settings';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Album Name')
                    ->placeholder('e.g., Victory Day Celebration')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('event_date')
                    ->label('Memory Date')
                    ->helperText('When did this event happen?')
                    ->required(),
                Toggle::make('is_featured')
                    ->label('Feature on Homepage')
                    ->helperText('If enabled, this album will appear in the 3 featured slots on the home page.')
                    ->default(false),
                FileUpload::make('images')
                    ->label('Photos')
                    ->multiple()
                    ->image()
                    ->imageResizeTargetWidth(1200)
                    ->imageEditor()
                    ->reorderable()
                    ->appendFiles()
                    ->disk('public')
                    ->directory('albums')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('images')
                    ->label('Preview')
                    ->circular()
                    ->stacked()
                    ->limit(3),
                TextColumn::make('title')
                    ->label('Album Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('event_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('images_count')
                    ->label('Photos')
                    ->state(fn (Album $record): int => count($record->images ?? [])),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAlbums::route('/'),
        ];
    }
}
