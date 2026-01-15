<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pages';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Page';

    protected static ?string $pluralModelLabel = 'Pages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations')
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
                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true),
                ]),
            Forms\Components\Section::make('Contenu')
                ->schema([
                    Forms\Components\Builder::make('content')
                        ->label('Contenu')
                        ->blocks([
                            Forms\Components\Builder\Block::make('heading')
                                ->label('Titre')
                                ->schema([
                                    Forms\Components\TextInput::make('content')
                                        ->label('Texte')
                                        ->required(),
                                    Forms\Components\Select::make('level')
                                        ->label('Niveau')
                                        ->options([
                                            'h1' => 'H1',
                                            'h2' => 'H2',
                                            'h3' => 'H3',
                                            'h4' => 'H4',
                                        ])
                                        ->default('h2')
                                        ->required(),
                                ]),
                            Forms\Components\Builder\Block::make('paragraph')
                                ->label('Paragraphe')
                                ->schema([
                                    Forms\Components\RichEditor::make('content')
                                        ->label('Contenu')
                                        ->required(),
                                ]),
                            Forms\Components\Builder\Block::make('image')
                                ->label('Image')
                                ->schema([
                                    Forms\Components\FileUpload::make('url')
                                        ->label('Image')
                                        ->image()
                                        ->directory('pages')
                                        ->required(),
                                    Forms\Components\TextInput::make('alt')
                                        ->label('Texte alternatif'),
                                ]),
                            Forms\Components\Builder\Block::make('quote')
                                ->label('Citation')
                                ->schema([
                                    Forms\Components\Textarea::make('content')
                                        ->label('Citation')
                                        ->required(),
                                    Forms\Components\TextInput::make('author')
                                        ->label('Auteur'),
                                ]),
                        ])
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('SEO')
                ->collapsed()
                ->schema([
                    Forms\Components\KeyValue::make('meta')
                        ->label('Meta')
                        ->keyLabel('Cle')
                        ->valueLabel('Valeur')
                        ->addActionLabel('Ajouter meta')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->badge(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifie le')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
