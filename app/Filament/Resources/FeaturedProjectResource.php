<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedProjectResource\Pages;
use App\Filament\Resources\FeaturedProjectResource\RelationManagers;
use App\Models\FeaturedProject;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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

class FeaturedProjectResource extends Resource
{
    protected static ?string $model = FeaturedProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $navigationLabel = 'Featured Projects';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make('title')
                    ->required(),
                Toggle::make('is_featured'),
                FileUpload::make('img')
                    ->image()
                    ->directory('page/photos')
                    ->nullable(),
               TextInput::make('category'),
               Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(10)
                    ->cols(20),
               
            ]);
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
            'index' => Pages\ListFeaturedProjects::route('/'),
            'create' => Pages\CreateFeaturedProject::route('/create'),
            'edit' => Pages\EditFeaturedProject::route('/{record}/edit'),
        ];
    }
}
