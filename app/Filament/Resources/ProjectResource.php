<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Projects';

    protected static ?string $navigationLabel = 'Projects';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Details')->schema(
                    [
                    TextInput::make('name')
                    
                    ->required()
                            ->live()
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit') {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                    TextInput::make('address')
                    ->columnSpanFull(),

                    Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(5),

                    ])->columnSpan(2),

                    Section::make(' ')->schema(
                        [
                            DatePicker::make('published_at')
                            ->label('Date')
                            ->date()
                            ->default('now'),

                            FileUpload::make('img')
                            ->label('Project Picture')
                            ->image()
                            ->directory('projects/photos'),

                            Select::make('category')
                            ->options([
                                'Malls' => 'Malls',
                                'Power Plants' => 'Power Plants',
                                'Office Buildings' => 'Office Buildings',
                                'Hotel and Resorts' => 'Hotel and Resorts',
                                'Pharmaceutical Plants' => 'Pharmaceutical Plants',
                                'Schools and Universities' => 'Schools and Universities',
                                'Government Building' => 'Government Building',
                                'Supermarket' => 'Supermarket',
                                'Mixed Development' => 'Mixed Development',
                                'Healthcare' => 'Healthcare',
                                'Green Building' => 'Green Building',
                                'Airports' => 'Airports',
                                'Manufacturing Plant' => 'Manufacturing Plant',
                                'Hospitals and Medical Center' => 'Hospitals and Medical Center',
                                
                            ])
                            ->required(),

                            TagsInput::make('tag')
                            ->color('success')
                            ->reorderable()
                            ->separator(','),

                            TextInput::make('slug')
                            // ->disabled()
                                ->required(),

                            Toggle::make('status')
                                ->required()
                                ->default(true),

                            Toggle::make('featured')
                                ->required()
                                ->default(false),
                           
                        ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultPaginationPageOption(50)
            ->columns([
                ImageColumn::make('img'),
                TextColumn::make('name')
                    ->searchable(),
                
                TextColumn::make('category')
                    ->searchable(),
                TextColumn::make('tag')
                ->badge()
                    ->searchable(),
                    ToggleColumn::make('status'),
                    ToggleColumn::make('featured'),
            ])->defaultSort('created_at','desc')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
