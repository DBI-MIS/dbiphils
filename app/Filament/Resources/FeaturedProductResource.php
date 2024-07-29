<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedProductResource\Pages;
use App\Filament\Resources\FeaturedProductResource\RelationManagers;
use App\Models\FeaturedProduct;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturedProductResource extends Resource
{
    protected static ?string $model = FeaturedProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $navigationLabel = 'Featured Products';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('category'),
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(10)
                            ->cols(20),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        Toggle::make('is_featured'),
                        FileUpload::make('img')
                            ->image()
                            ->directory('page/photos')
                            ->nullable(),
                    ])->columnSpan(1),





            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                    ->wrap(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('category')
                    ->searchable(),
                ToggleColumn::make('is_featured'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFeaturedProducts::route('/'),
            'create' => Pages\CreateFeaturedProduct::route('/create'),
            'edit' => Pages\EditFeaturedProduct::route('/{record}/edit'),
        ];
    }
}
