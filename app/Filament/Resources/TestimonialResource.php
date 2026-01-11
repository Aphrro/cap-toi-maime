<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $navigationLabel = 'Temoignages';

    protected static ?string $modelLabel = 'Temoignage';

    protected static ?string $pluralModelLabel = 'Temoignages';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->label('Nom de l\'auteur')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('author_role')
                            ->label('Role (ex: Parent, Maman de 2 enfants)')
                            ->maxLength(100),
                        Forms\Components\Textarea::make('content')
                            ->label('Temoignage')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000),
                        Forms\Components\Select::make('rating')
                            ->label('Note')
                            ->options([
                                5 => '5 etoiles',
                                4 => '4 etoiles',
                                3 => '3 etoiles',
                                2 => '2 etoiles',
                                1 => '1 etoile',
                            ])
                            ->default(5)
                            ->required(),
                        Forms\Components\Toggle::make('is_approved')
                            ->label('Approuve')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author_role')
                    ->label('Role')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Temoignage')
                    ->limit(50),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Note')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Approuve')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Approuve'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Testimonial $record) => !$record->is_approved)
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => true])),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
