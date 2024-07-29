<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResponseResource\Pages;
use App\Filament\Resources\ProductResponseResource\RelationManagers;
use App\Models\ProductResponse;
use App\ResponseStatus;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ProductResponseResource extends Resource
{
    protected static ?string $model = ProductResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Form Inquiries';

    protected static ?string $navigationLabel = 'Product Inquiries';
    
    protected static ?string $label = 'Product Inquiries';

    protected static ?int $navigationSort = 2;


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
                        Select::make('product_title')
                            ->relationship('product', 'title')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label(__('Product'))
                            ->columnSpanFull(),
                        TextInput::make('full_name')
                            ->required()
                            ->label(__('Full Name'))
                            // ->live(onBlur:true)
                            ->hint('  ')
                            ->columnSpanFull(),
                        // Radio::make('status')->options(ResponseStatus::class),
                        Textarea::make('message')
                            ->columnSpanFull()
                            ->required()
                            ->label(__('Inquiry Message'))
                            ->hint('  ')
                            ->rows(5),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        DatePicker::make('date_response')
                            ->required()
                            ->readonly()
                            ->closeOnDateSelection()
                            ->default(now())
                            ->label(__('Date')),
                        TextInput::make('contact')
                            ->tel()
                            ->maxLength(11)
                            ->label(__('Contact Number')),
                        TextInput::make('email_address')
                            ->email()
                            ->label(__('Email Address')),
                    ])->columnSpan(1),





            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('date_response')
                    ->date()
                    ->sortable()
                    ->label(__('Date'))
                    ->alignCenter(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->label(__('Name'))
                    ->alignCenter(),
                TextColumn::make('product.title')
                    ->label(__('Product'))
                    ->sortable()
                    ->alignCenter(),
                IconColumn::make('review')
                    ->boolean()
                    ->label(__('Reviewed'))
                    ->sortable()
                    ->alignCenter(),
                SelectColumn::make('status')
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->searchable()
                    ->grow(false)
                    ->alignCenter()
                    ->options([
                        'pending' => 'pending',
                        'reviewed' => 'reviewed',
                    ])
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state === 'reviewed') {
                            $record->review = true;
                            $record->save();
                        }
                    }),

            ])->defaultSort('date_response', 'desc')
            ->heading('Product Inquiry Form Responses')
            ->filters([

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                            ->withFilename(date(Carbon::now()) . ' - Product Inquiry Responses')
                            ->withColumns([
                                Column::make('date_response')
                                    ->heading('Date of Inquiry'),
                                Column::make('full_name')
                                    ->heading('Name'),
                                Column::make('product.title')
                                    ->heading('Product Inquired'),
                                Column::make('contact')
                                    ->heading('Contact No.'),
                                Column::make('email_address')
                                    ->heading('Email Address'),
                                Column::make('status')
                                    ->heading('Status'),
                            ]),
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProductResponses::route('/'),
            'create' => Pages\CreateProductResponse::route('/create'),
            // 'view' => Pages\ViewProductResponse::route('/{record}'),
            'edit' => Pages\EditProductResponse::route('/{record}/edit'),
        ];
    }
}
