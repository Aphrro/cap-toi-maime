<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Parametres';

    protected static ?string $navigationGroup = 'Système';

    protected static ?string $modelLabel = 'Parametre';

    protected static ?string $pluralModelLabel = 'Parametres';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Parametre')
                ->schema([
                    Forms\Components\Select::make('group')
                        ->label('Groupe')
                        ->options([
                            'general' => 'General',
                            'contact' => 'Contact',
                            'social' => 'Reseaux sociaux',
                            'seo' => 'SEO',
                            'email' => 'Email',
                            'membership' => 'Adhesion',
                            'events' => 'Evenements',
                        ])
                        ->required()
                        ->native(false),
                    Forms\Components\TextInput::make('key')
                        ->label('Cle')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('Identifiant unique du parametre'),
                    Forms\Components\TextInput::make('label')
                        ->label('Libelle')
                        ->maxLength(255)
                        ->helperText('Nom affiche pour ce parametre'),
                    Forms\Components\Select::make('type')
                        ->label('Type')
                        ->options([
                            'text' => 'Texte',
                            'textarea' => 'Zone de texte',
                            'number' => 'Nombre',
                            'boolean' => 'Oui/Non',
                            'json' => 'JSON',
                            'email' => 'Email',
                            'url' => 'URL',
                        ])
                        ->default('text')
                        ->required()
                        ->native(false),
                    Forms\Components\Textarea::make('value')
                        ->label('Valeur')
                        ->rows(3),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group')
                    ->label('Groupe')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'general' => 'gray',
                        'contact' => 'info',
                        'social' => 'success',
                        'seo' => 'warning',
                        'email' => 'primary',
                        'membership' => 'danger',
                        'events' => 'secondary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Reseaux sociaux',
                        'seo' => 'SEO',
                        'email' => 'Email',
                        'membership' => 'Adhesion',
                        'events' => 'Evenements',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('key')
                    ->label('Cle')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Libelle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valeur')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifie le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('group')
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Groupe')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Reseaux sociaux',
                        'seo' => 'SEO',
                        'email' => 'Email',
                        'membership' => 'Adhesion',
                        'events' => 'Evenements',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'text' => 'Texte',
                        'textarea' => 'Zone de texte',
                        'number' => 'Nombre',
                        'boolean' => 'Oui/Non',
                        'json' => 'JSON',
                        'email' => 'Email',
                        'url' => 'URL',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
