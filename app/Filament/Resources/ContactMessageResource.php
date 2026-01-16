<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Messages';

    protected static ?string $navigationLabel = 'Messages de contact';

    protected static ?string $modelLabel = 'Message';

    protected static ?string $pluralModelLabel = 'Messages de contact';

    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Message')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->label('Message')
                            ->disabled()
                            ->columnSpanFull()
                            ->rows(6),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('Adresse IP')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Date')
                            ->disabled(),
                        Forms\Components\Toggle::make('is_read')
                            ->label('Lu'),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('Repondu le'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->width('40px'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight(fn (ContactMessage $record): string => $record->is_read ? 'normal' : 'bold'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('replied_at')
                    ->label('Repondu')
                    ->boolean()
                    ->getStateUsing(fn (ContactMessage $record): bool => $record->replied_at !== null)
                    ->trueIcon('heroicon-o-check')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Statut')
                    ->placeholder('Tous')
                    ->trueLabel('Lus')
                    ->falseLabel('Non lus'),
                Tables\Filters\TernaryFilter::make('replied')
                    ->label('Repondu')
                    ->placeholder('Tous')
                    ->trueLabel('Oui')
                    ->falseLabel('Non')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('replied_at'),
                        false: fn (Builder $query) => $query->whereNull('replied_at'),
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('markRead')
                    ->label('Marquer lu')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (ContactMessage $record): bool => !$record->is_read)
                    ->action(fn (ContactMessage $record) => $record->markAsRead()),
                Tables\Actions\Action::make('reply')
                    ->label('Repondre')
                    ->icon('heroicon-o-envelope')
                    ->color('primary')
                    ->url(fn (ContactMessage $record): string => "mailto:{$record->email}?subject=Re: {$record->subject}")
                    ->openUrlInNewTab()
                    ->after(function (ContactMessage $record) {
                        $record->update(['replied_at' => now()]);
                        $record->markAsRead();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Marquer comme lus')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->markAsRead())
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
