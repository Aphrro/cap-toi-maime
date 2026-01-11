<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CantonResource\Pages;
use App\Models\Canton;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CantonResource extends Resource
{
    protected static ?string $model = Canton::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Parametres';

    protected static ?string $navigationLabel = 'Cantons';

    protected static ?string $modelLabel = 'Canton';

    protected static ?string $pluralModelLabel = 'Cantons';

    protected static ?int $navigationSort = 3;

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
                        Forms\Components\TextInput::make('code')
                            ->label('Code')
                            ->required()
                            ->maxLength(2)
                            ->placeholder('GE, VD, VS...'),
                    ])
                    ->columns(2),
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
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cities_count')
                    ->label('Villes')
                    ->counts('cities')
                    ->badge(),
            ])
            ->defaultSort('name')
            ->filters([
                //
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
            'index' => Pages\ListCantons::route('/'),
            'create' => Pages\CreateCanton::route('/create'),
            'edit' => Pages\EditCanton::route('/{record}/edit'),
        ];
    }
}
