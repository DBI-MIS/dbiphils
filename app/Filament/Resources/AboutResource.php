<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use RalphJSmit\Filament\SEO\SEO;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $navigationLabel = 'About Us';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Section::make('About Us')
                    ->description(' ')
                    ->schema([



                        TextInput::make('title')
                            ->required(),

                        MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'heading',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                                'paragraph',
                            ]),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        FileUpload::make('img')
                            ->directory('about/photos')
                            ->nullable(),
                    ])->columnSpan(1),

                // Repeater::make('')
                //     ->schema([
                //     Textarea::make('desc_array')
                //     ,
                //     ])->columnSpanFull(),




                // // SEO::make()->hidden(),
            ])->columns(3);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                ImageColumn::make('img')->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                            ->withFilename(date(Carbon::now()) . ' - About Data Export')
                            ->withColumns([
                                Column::make('title'),
                                Column::make('img'),
                                Column::make('description'),
                                Column::make('desc_array'),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
