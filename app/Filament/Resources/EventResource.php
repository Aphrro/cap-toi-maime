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

    protected static ?string $navigationLabel = 'Evenements';

    protected static ?string $navigationGroup = 'Evenements';

    protected static ?string $modelLabel = 'Evenement';

    protected static ?string $pluralModelLabel = 'Evenements';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations generales')
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
                    Forms\Components\RichEditor::make('description')
                        ->label('Description')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->directory('events')
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Date et lieu')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Date de debut')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Date de fin')
                            ->required()
                            ->after('start_date'),
                    ]),
                    Forms\Components\TextInput::make('location')
                        ->label('Lieu')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('address')
                        ->label('Adresse')
                        ->rows(2),
                ]),
            Forms\Components\Section::make('Capacite')
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
                ]),
            Forms\Components\Section::make('Statut')
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date debut')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registrations_count')
                    ->label('Inscriptions')
                    ->counts('registrations')
                    ->sortable(),
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
            ->defaultSort('start_date', 'desc')
            ->filters([
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
