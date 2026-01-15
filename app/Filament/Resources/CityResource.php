<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Paramètres';

    protected static ?string $navigationLabel = 'Villes';

    protected static ?string $modelLabel = 'Ville';

    protected static ?string $pluralModelLabel = 'Villes';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('Code postal')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\Select::make('canton_id')
                            ->label('Canton')
                            ->relationship('canton', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('latitude')
                                ->numeric(),
                            Forms\Components\TextInput::make('longitude')
                                ->numeric(),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label('Code postal')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('canton.name')
                    ->label('Canton')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('professionals_count')
                    ->label('Professionnels')
                    ->counts('professionals')
                    ->badge(),
            ])
            ->defaultSort('name')
            ->filters([
                Tables\Filters\SelectFilter::make('canton_id')
                    ->label('Canton')
                    ->relationship('canton', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
