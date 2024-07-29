<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainpageResource\Pages;
use App\Filament\Resources\MainpageResource\RelationManagers;
use App\Models\Mainpage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MainpageResource extends Resource
{
    protected static ?string $model = Mainpage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $navigationLabel = 'Main';
    
    protected static ?string $label = 'Main Pages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        Select::make('section')
                            ->options([
                                'main' => 'main',
                                'featured' => 'featured',
                                'background' => 'background',
                            ]),
                        TextInput::make('title'),
                        Textarea::make('notes')
                            ->rows(10)
                            ->cols(20)
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
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
            ->defaultPaginationPageOption(25)
            ->columns([
                ImageColumn::make('img')->wrap(),
                TextColumn::make('title'),
                SelectColumn::make('section')
                    ->options([
                        'main' => 'main',
                        'featured' => 'featured',
                        'background' => 'background',
                    ]),
                TextColumn::make('notes')->wrap(),
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
            'index' => Pages\ListMainpages::route('/'),
            'create' => Pages\CreateMainpage::route('/create'),
            'edit' => Pages\EditMainpage::route('/{record}/edit'),
        ];
    }
}
