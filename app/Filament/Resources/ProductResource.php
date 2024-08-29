<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Carbon\Carbon;
use DiscoveryDesign\FilamentGaze\Forms\Components\GazeBanner;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Products';

    protected ?string $subheading = 'This is the subheading.';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                GazeBanner::make()
                ->lock()
                ->canTakeControl()
                ->hideOnCreate()
                ->columnSpanFull(),

                Section::make('Main Content')->schema(
                    [


                        TextInput::make('title')->label('Product Name')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit') {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        Select::make('brand_id')
                            ->relationship('product_brand', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->label(__('Brand')),



                        RichEditor::make('description')
                            ->nullable()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'italic',
                                'redo',
                                'underline',
                                'undo',
                            ]),
                        RichEditor::make('features')
                            ->nullable()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'italic',
                                'redo',
                                'underline',
                                'undo',
                            ]),
                        RichEditor::make('technical_specs')
                            ->nullable()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'italic',
                                'redo',
                                'underline',
                                'undo',
                            ]),
                        RichEditor::make('capacity')
                            ->nullable()
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'italic',
                                'redo',
                                'underline',
                                'undo',
                            ]),

                    ]
                )->columnSpan(2),
                /////////////////////////////////////////////////////////////////
                Section::make(' ')->schema(
                    [
                        Section::make(' ')->schema(
                            [
                                DatePicker::make('date_posted')
                                    ->required()
                                    ->default(Carbon::now()),
                                Toggle::make('featured')
                                    ->required(),

                                Toggle::make('status')
                                    ->required(),
                            ]
                        ),

                        FileUpload::make('product_img')
                            ->image()->directory('products/photos')
                            ->nullable(),




                        Select::make('product_categories')
                            ->multiple()
                            ->relationship('product_categories', 'title')
                            ->searchable()
                            ->preload()
                            ->label(__('Product Categories'))
                            ->helperText('Choose the feature first & inlcude atleast 1 section name: Airconditioning,
                    Refrigeration, Ventilation, Cooling Tower.. etc.
                    '),




                        RichEditor::make('equipment_application')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'italic',
                                'redo',
                                'underline',
                                'undo',
                            ]),

                        Select::make('equipment_header')
                            ->label('Assign to Section')
                            ->options([
                                'Airconditioning' => 'Airconditioning',
                                'Refrigeration' => 'Refrigeration',
                                'Ventilation' => 'Ventilation',
                                'ProMED AtmosAir' => 'ProMED AtmosAir',
                                'EP Solutions' => 'EP Solutions',
                                'Other Products' => 'Other Products',

                            ])->required(),

                        TextInput::make('slug')
                            ->required()
                            ->minLength(1)->unique(ignoreRecord: true)->maxLength(150),

                        Select::make('user_id')
                            ->relationship('writer', 'name')
                            ->searchable()
                            ->default('2')
                            ->required()
                            ->preload(),
                    ]
                )->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product_img')

                    ->wrap()
                    ->label('Product'),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Name'),
                TextColumn::make('product_brand.name')
                    ->searchable()
                    ->label('Brand'),
                TextColumn::make('product_categories.title')
                    ->label('Category')->badge(),
                TextColumn::make('equipment_header')
                    ->label('Section')
                    ->searchable(),
                ToggleColumn::make('status')->label('Active'),
                ToggleColumn::make('featured'),
            ])->defaultSort('created_at', 'asc')
            ->defaultPaginationPageOption(50)
            ->filters([
                SelectFilter::make('brand_id')
                    ->label('Select Brand')
                    ->relationship('product_brand', 'name'),
                TernaryFilter::make('featured')
                    ->label('On Frontpage'),
                TernaryFilter::make('status')
                    ->label('Active'),
            ])->persistFiltersInSession()
            ->deferFilters()
            ->filtersApplyAction(
                fn (Action $action) => $action
                    ->link()
                    ->label('Apply Filter'),
            )
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
