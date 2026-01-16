<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReimbursementTypeResource\Pages;
use App\Models\ReimbursementType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReimbursementTypeResource extends Resource
{
    protected static ?string $model = ReimbursementType::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Types de remboursement';

    protected static ?string $navigationGroup = 'Annuaire';

    protected static ?string $modelLabel = 'Type de remboursement';

    protected static ?string $pluralModelLabel = 'Types de remboursement';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Type de remboursement')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('code')
                        ->label('Code')
                        ->required()
                        ->maxLength(50)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->rows(3),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('professionals_count')
                    ->label('Professionnels')
                    ->counts('professionals')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifie le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
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
            'index' => Pages\ListReimbursementTypes::route('/'),
            'create' => Pages\CreateReimbursementType::route('/create'),
            'edit' => Pages\EditReimbursementType::route('/{record}/edit'),
        ];
    }
}
