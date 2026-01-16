<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Événements';

    protected static ?string $navigationGroup = 'Événements';

    protected static ?string $modelLabel = 'Événement';

    protected static ?string $pluralModelLabel = 'Événements';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Evenement')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Informations')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Titre')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            Forms\Components\Select::make('event_type')
                                ->label('Type d\'evenement')
                                ->options([
                                    'general' => 'General',
                                    'speed_dating' => 'Speed Dating Therapeutes/Parents',
                                    'conference' => 'Conference',
                                    'workshop' => 'Atelier',
                                ])
                                ->default('general')
                                ->required()
                                ->live(),
                            Forms\Components\RichEditor::make('description')
                                ->label('Description')
                                ->toolbarButtons(['bold', 'italic', 'bulletList', 'link']),
                            Forms\Components\FileUpload::make('image')
                                ->label('Image')
                                ->image()
                                ->directory('events'),
                        ]),

                    Forms\Components\Tabs\Tab::make('Date et lieu')
                        ->icon('heroicon-o-calendar')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\DateTimePicker::make('start_date')
                                    ->label('Date de debut')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('end_date')
                                    ->label('Date de fin')
                                    ->after('start_date'),
                            ]),
                            Forms\Components\TextInput::make('location')
                                ->label('Lieu')
                                ->maxLength(255),
                            Forms\Components\Textarea::make('address')
                                ->label('Adresse')
                                ->rows(2),
                        ]),

                    Forms\Components\Tabs\Tab::make('Inscription')
                        ->icon('heroicon-o-user-plus')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('max_professionals')
                                    ->label('Max professionnels')
                                    ->numeric()
                                    ->minValue(0),
                                Forms\Components\TextInput::make('max_members')
                                    ->label('Max membres')
                                    ->numeric()
                                    ->minValue(0),
                            ]),
                            Forms\Components\Toggle::make('registration_required')
                                ->label('Inscription obligatoire')
                                ->live(),
                            Forms\Components\TextInput::make('registration_url')
                                ->label('Lien d\'inscription externe')
                                ->url()
                                ->visible(fn ($get) => $get('registration_required'))
                                ->helperText('Si vous utilisez un formulaire externe'),
                        ]),

                    Forms\Components\Tabs\Tab::make('Therapeutes presents')
                        ->icon('heroicon-o-users')
                        ->visible(fn ($get) => $get('event_type') === 'speed_dating')
                        ->schema([
                            Forms\Components\Placeholder::make('speed_dating_info')
                                ->content('Selectionnez les therapeutes qui seront presents a ce Speed Dating.')
                                ->columnSpanFull(),
                            Forms\Components\Select::make('professionals')
                                ->label('Therapeutes participants')
                                ->relationship('professionals', 'id')
                                ->getOptionLabelFromRecordUsing(fn ($record) =>
                                    $record->full_name . ' - ' . ($record->profession?->name ?? 'N/A')
                                )
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->optionsLimit(50),
                        ]),

                    Forms\Components\Tabs\Tab::make('Statut')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->label('Statut')
                                ->options([
                                    'draft' => 'Brouillon',
                                    'published' => 'Publie',
                                    'cancelled' => 'Annule',
                                    'completed' => 'Termine',
                                ])
                                ->required()
                                ->default('draft')
                                ->native(false),
                        ]),
                ])
                ->columnSpanFull()
                ->persistTabInQueryString(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('event_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match($state) {
                        'speed_dating' => 'Speed Dating',
                        'conference' => 'Conference',
                        'workshop' => 'Atelier',
                        default => 'General',
                    })
                    ->color(fn (?string $state): string => match($state) {
                        'speed_dating' => 'success',
                        'conference' => 'info',
                        'workshop' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('professionals_count')
                    ->label('Therapeutes')
                    ->counts('professionals')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'draft' => 'Brouillon',
                        'published' => 'Publie',
                        'cancelled' => 'Annule',
                        'completed' => 'Termine',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Cree le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_date', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('event_type')
                    ->label('Type')
                    ->options([
                        'general' => 'General',
                        'speed_dating' => 'Speed Dating',
                        'conference' => 'Conference',
                        'workshop' => 'Atelier',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'draft' => 'Brouillon',
                        'published' => 'Publie',
                        'cancelled' => 'Annule',
                        'completed' => 'Termine',
                    ]),
                Tables\Filters\Filter::make('upcoming')
                    ->label('A venir')
                    ->query(fn ($query) => $query->upcoming()),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('publish')
                        ->label('Publier')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $record->status === 'draft')
                        ->requiresConfirmation()
                        ->action(fn ($record) => $record->update(['status' => 'published'])),
                    Tables\Actions\Action::make('cancel')
                        ->label('Annuler')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn ($record) => in_array($record->status, ['draft', 'published']))
                        ->requiresConfirmation()
                        ->action(fn ($record) => $record->update(['status' => 'cancelled'])),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
