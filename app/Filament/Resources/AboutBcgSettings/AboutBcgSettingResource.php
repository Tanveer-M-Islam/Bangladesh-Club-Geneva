<?php

namespace App\Filament\Resources\AboutBcgSettings;

use App\Filament\Resources\AboutBcgSettings\Pages\EditAboutBcgSetting;
use App\Filament\Resources\AboutBcgSettings\Pages\ListAboutBcgSettings;
use App\Models\AboutBcgSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms\Components\Repeater;

class AboutBcgSettingResource extends Resource
{
    protected static ?string $model = AboutBcgSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $label = 'About BCG Settings';

    protected static ?string $pluralLabel = 'About BCG Settings';

    protected static ?string $navigationLabel = 'About BCG Settings';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('President Information')
                    ->description('Manage the President\'s name, photo, and message.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('president_name')
                            ->label('President Name')
                            ->placeholder('e.g., Nurul Islam')
                            ->required(),
                        FileUpload::make('president_image_path')
                            ->label('President Photo')
                            ->image()
                            ->imageResizeTargetWidth(800)
                            ->directory('about')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),
                        RichEditor::make('president_speech')
                            ->label('President\'s Speech')
                            ->placeholder('Message from the President...')
                            ->helperText('Recommended: Keep it between 100-300 words for the best homepage look.')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('General Secretary Information')
                    ->description('Manage the General Secretary\'s name, photo, and message.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('gs_name')
                            ->label('General Secretary Name')
                            ->placeholder('e.g., Maroof Anwar')
                            ->required(),
                        FileUpload::make('gs_image_path')
                            ->label('General Secretary Photo')
                            ->image()
                            ->imageResizeTargetWidth(800)
                            ->directory('about')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),
                        RichEditor::make('gs_speech')
                            ->label('General Secretary\'s Speech')
                            ->placeholder('Message from the General Secretary...')
                            ->helperText('Recommended: Keep it between 100-300 words for the best homepage look.')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Schemas\Components\Tabs::make('About Us Page Content')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Mission')
                            ->icon('heroicon-o-flag')
                            ->schema([
                                TextInput::make('mission_title')
                                    ->label('Mission Title')
                                    ->default('Our Mission')
                                    ->required(),
                                FileUpload::make('mission_image_path')
                                    ->label('Mission Image')
                                    ->image()
                                    ->directory('about-us')
                                    ->disk('public')
                                    ->visibility('public'),
                                RichEditor::make('mission_text')
                                    ->label('Mission Text')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        \Filament\Schemas\Components\Tabs\Tab::make('Vision')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                TextInput::make('vision_title')
                                    ->label('Vision Title')
                                    ->default('Our Vision')
                                    ->required(),
                                FileUpload::make('vision_image_path')
                                    ->label('Vision Image')
                                    ->image()
                                    ->directory('about-us')
                                    ->disk('public')
                                    ->visibility('public'),
                                RichEditor::make('vision_text')
                                    ->label('Vision Text')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        \Filament\Schemas\Components\Tabs\Tab::make('Terms & Rules')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('terms_title')
                                    ->label('Section Title')
                                    ->default('Committee Terms and Rules')
                                    ->required(),
                                FileUpload::make('terms_image_path')
                                    ->label('Related Image')
                                    ->image()
                                    ->directory('about-us')
                                    ->disk('public')
                                    ->visibility('public'),
                                RichEditor::make('terms_text')
                                    ->label('Terms and Rules Content')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        \Filament\Schemas\Components\Tabs\Tab::make('Executive Committee')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Repeater::make('executive_members')
                                    ->label('Executive Members')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Member Name')
                                            ->required(),
                                        TextInput::make('designation')
                                            ->label('Designation / Role')
                                            ->required(),
                                        FileUpload::make('image_path')
                                            ->label('Member Photo')
                                            ->image()
                                            ->imageResizeTargetWidth(500)
                                            ->directory('executive-committee')
                                            ->disk('public')
                                            ->visibility('public'),
                                    ])
                                    ->columns(3)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('General Members')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Repeater::make('general_members')
                                    ->label('General Members List')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Member Name')
                                            ->required(),
                                        FileUpload::make('image_path')
                                            ->label('Member Photo')
                                            ->image()
                                            ->directory('general-members')
                                            ->disk('public')
                                            ->visibility('public'),
                                        TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->tel(),
                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->email(),
                                        TextInput::make('blood_group')
                                            ->label('Blood Group')
                                            ->placeholder('e.g., A+'),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('president_name')
                    ->placeholder('-'),
                ImageEntry::make('president_image_path')
                    ->placeholder('-'),
                TextEntry::make('president_speech')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('gs_name')
                    ->placeholder('-'),
                ImageEntry::make('gs_image_path')
                    ->placeholder('-'),
                TextEntry::make('gs_speech')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('mission_title')
                    ->placeholder('-'),
                ImageEntry::make('mission_image_path')
                    ->placeholder('-'),
                TextEntry::make('vision_title')
                    ->placeholder('-'),
                ImageEntry::make('vision_image_path')
                    ->placeholder('-'),
                TextEntry::make('terms_title')
                    ->placeholder('-'),
                ImageEntry::make('terms_image_path')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('president_name')
            ->columns([
                TextColumn::make('president_name')
                    ->searchable(),
                ImageColumn::make('president_image_path'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
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
            'index' => ListAboutBcgSettings::route('/'),
            'edit' => EditAboutBcgSetting::route('/{record}/edit'),
        ];
    }
}
