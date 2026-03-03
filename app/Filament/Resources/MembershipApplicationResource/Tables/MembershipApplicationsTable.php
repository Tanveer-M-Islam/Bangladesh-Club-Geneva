<?php

namespace App\Filament\Resources\MembershipApplicationResource\Tables;

use App\Models\AboutBcgSetting;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class MembershipApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('contact_number')
                    ->searchable(),
                TextColumn::make('blood_group')
                    ->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                    }),
                ImageColumn::make('member_photo')
                    ->label('Photo')
                    ->disk('public')
                    ->circular(),
                ImageColumn::make('payment_proof')
                    ->label('Proof')
                    ->disk('public'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Action::make('approve')
                    ->action(function ($record) {
                        if ($record->status === 'active') {
                            Notification::make()
                                ->title('Already active')
                                ->warning()
                                ->send();
                            return;
                        }

                        // The model's 'updated' event will handle the sync automatically
                        $record->update(['status' => 'active']);

                        Notification::make()
                            ->title('Application approved and synced to General Members')
                            ->success()
                            ->send();
                    })
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
