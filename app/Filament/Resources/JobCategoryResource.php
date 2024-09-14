<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobCategoryResource\Pages;
use App\Filament\Resources\JobCategoryResource\RelationManagers;
use App\Forms\Components\JobCategoryPreview;
use App\Models\JobCategory;
use DiscoveryDesign\FilamentGaze\Forms\Components\GazeBanner;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class JobCategoryResource extends Resource
{
    protected static ?string $model = JobCategory::class;

    protected static ?string $navigationIcon = 'heroicon-s-tag';

    protected static ?string $navigationGroup = 'Job Post';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                GazeBanner::make()
                    ->lock()
                    ->canTakeControl()
                    ->hideOnCreate()
                    ->columnSpanFull(),
                Section::make('Category')
                    ->description(' ')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label(__('Category'))
                            ->live(onBlur: true)
                            ->columnSpan(1)
                            ->afterStateUpdated(
                                function (string $operation, string $state, Forms\Set $set) {
                                    if ($operation === 'edit') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }
                            ),
                        Hidden::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        ToggleButtons::make('text_color')->default('white')
                            ->required()
                            ->options([
                                'gray' => 'gray',
                                'white' => 'white',
                                'blue' => 'blue',
                                'red' => 'red',
                                'yellow' => 'yellow',
                                'green' => 'green',
                            ])
                            ->grouped()
                            ->live()
                            ->label(__('Text Color')),


                        ToggleButtons::make('bg_color')->default('blue')
                            ->required()
                            ->live()
                            ->options([
                                'gray' => 'gray',
                                'blue' => 'blue',
                                'red' => 'red',
                                'yellow' => 'yellow',
                                'green' => 'green',
                            ])
                            ->grouped()
                            ->label(__('Background Color')),
                    ])->columnSpan(2),
                Section::make('Color Preview')
                    ->description(' ')
                    ->schema([
                        JobCategoryPreview::make('color')
                            ->label(' ')
                            ->options(function (callable $get) {
                                $textColor = 'text-white';
                                $bgColor = 'bg-blue-500';

                                if ($get('text_color') === 'gray') {
                                    $textColor = 'text-gray-500';
                                } elseif ($get('text_color') === 'blue') {
                                    $textColor = 'text-blue-500';
                                } elseif ($get('text_color') === 'red') {
                                    $textColor = 'text-red-500';
                                } elseif ($get('text_color') === 'yellow') {
                                    $textColor = 'text-yellow-500';
                                } elseif ($get('text_color') === 'green') {
                                    $textColor = 'text-green-500';
                                } elseif ($get('text_color') === 'white') {
                                    $textColor = 'text-white';
                                }

                                if ($get('bg_color') === 'gray') {
                                    $bgColor = 'bg-gray-500';
                                } elseif ($get('bg_color') === 'blue') {
                                    $bgColor = 'bg-blue-500';
                                } elseif ($get('bg_color') === 'red') {
                                    $bgColor = 'bg-red-500';
                                } elseif ($get('bg_color') === 'yellow') {
                                    $bgColor = 'bg-yellow-500';
                                } elseif ($get('bg_color') === 'green') {
                                    $bgColor = 'bg-green-500';
                                }

                                return ["$textColor $bgColor" => ucfirst($get('text_color') ?? 'blue') . ' & ' . ucfirst($get('bg_color') ?? 'blue')];
                            }),




                    ])->columnSpan(1),


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('Category Name')),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListJobCategories::route('/'),
            'create' => Pages\CreateJobCategory::route('/create'),
            // 'view' => Pages\ViewJobCategory::route('/{record}'),
            'edit' => Pages\EditJobCategory::route('/{record}/edit'),
        ];
    }
}
