<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerTestimonialResource\Pages;
use App\Filament\Resources\CareerTestimonialResource\RelationManagers;
use App\Models\CareerTestimonial;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
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

class CareerTestimonialResource extends Resource
{
    protected static ?string $model = CareerTestimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $label = 'Job Testimonials';

    protected static ?string $navigationGroup = 'Job Post';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Name of School/Company/Heading'),
                        TextInput::make('personnel')
                        ->label('Company/Person-in-charge'),
                        RichEditor::make('description')
                        ->label('Verbatim')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'italic',
                                'link',
                                'redo',
                                'strike',
                                'undo',
                            ]),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        Toggle::make('is_featured'),
                        FileUpload::make('img')
                            ->image()->directory('page/photos')
                            ->nullable()
                            ->label('Logo'),
                    ])->columnSpan(1),






            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->defaultSort('order','asc')
            ->reorderable('order')
            ->paginatedWhileReordering()
            ->recordUrl(null)
            ->columns([
                TextColumn::make('order')
                ->numeric(),
                TextColumn::make('title')
                ->limit(30)
                    ->searchable(),
                TextColumn::make('personnel')
                ->label('Company/Person-in-charge')
                    ->searchable()
                    ->limit(30),
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
            'index' => Pages\ListCareerTestimonials::route('/'),
            'create' => Pages\CreateCareerTestimonial::route('/create'),
            'edit' => Pages\EditCareerTestimonial::route('/{record}/edit'),
        ];
    }
}
