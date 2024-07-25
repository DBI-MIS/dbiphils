<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobPostResource\Pages;
use App\Filament\Resources\JobPostResource\RelationManagers;
use App\Models\JobPost;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class JobPostResource extends Resource
{
    protected static ?string $model = JobPost::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    protected static ?string $navigationGroup = 'Job Post';

    protected ?string $subheading = 'Job Post';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Job Details')
                    ->description(' ')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label(__('Job Title'))
                            ->live(onBlur: true)
                            ->columnSpan(2)
                            ->afterStateUpdated(
                                function (string $operation, string $state, Forms\Set $set) {
                                    if ($operation === 'edit') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }
                            ),



                        Select::make('jobcategories')
                            ->multiple()
                            ->relationship('jobcategories', 'title')
                            ->searchable()
                            ->preload()
                            ->hint('*select main category first')
                            ->label(__('Job Categories'))
                            ->createOptionForm([
                                TextInput::make('title')
                                    ->required()
                                    ->label(__('Category'))
                                    ->live(debounce: 300)
                                    // ->columns(3)
                                    ->afterStateUpdated(
                                        function (string $operation, string $state, Forms\Set $set) {
                                            $set('slug', Str::slug($state));
                                        }
                                    ),
                                    Hidden::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                ToggleButtons::make('text_color')
                                ->default('white')
                                    ->required()
                                    ->options([
                                        'white' => 'white',
                                        'blue' => 'blue',
                                        'red' => 'red',
                                        'yellow' => 'yellow',
                                        'green' => 'green',
                                    ])
                                    ->grouped()
                                    ->label(__('Text Color')),

                                ToggleButtons::make('bg_color')->default('blue')
                                    ->required()
                                    ->options([
                                        'gray' => 'gray',
                                        'blue' => 'blue',
                                        'red' => 'red',
                                        'yellow' => 'yellow',
                                        'green' => 'green',
                                    ])
                                    ->grouped()
                                    ->label(__('Background Color')),
                            ])->createOptionModalHeading('Create New Category')

                            ->columnSpan(2),






                        ToggleButtons::make('job_level')
                            ->required()
                            ->options([
                                'Entry Level' => 'Entry Level ',
                                'Supervisory' => 'Supervisory',
                                'Managerial' => 'Managerial',
                                'Internship' => 'Internship'
                            ])
                            ->grouped()
                            ->label(__('Job Level')),



                        RichEditor::make('post_description')
                            ->required()
                            ->label(__('Job Description'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'codeBlock',
                                'h2',
                                'h3',
                                'link',
                                'orderedList',
                                'strike',
                            ])
                            ->columnSpan(2),
                        RichEditor::make('post_responsibility')
                            ->required()
                            ->label(__('Job Responsibilities'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'codeBlock',
                                'h2',
                                'h3',
                                'link',
                                'orderedList',
                                'strike',
                            ])
                            ->columnSpan(2),
                        RichEditor::make('post_qualification')
                            ->required()
                            ->label(__('Job Qualifications'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'codeBlock',
                                'h2',
                                'h3',
                                'link',
                                'orderedList',
                                'strike',
                            ])
                            ->columnSpan(2),
                    ])->columnSpan(2),


                Section::make(' ')
                    ->description(' ')
                    ->schema([

                        DatePicker::make('date_posted')
                            ->required()
                            ->label(__('Date'))
                            ->readonly()
                            ->closeOnDateSelection()
                            ->default(now())
                            ->displayFormat('m/d/Y')
                            ->nullable(),

                        Toggle::make('featured')
                            ->label(__('Post to Frontpage'))
                            ->offColor('warning')
                            ->default(true)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->hintIcon('heroicon-o-information-circle', 'Set to "Enable" to show it on the Front Page'),

                        Toggle::make('status')
                            ->label(__('Active'))
                            ->offColor('warning')
                            ->default(true)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->hint(str('What is this?'))
                            ->hintIcon('heroicon-o-information-circle', 'Set to "Active" to show it on the Search Job Page'),

                        // ToggleButtons::make('job_type')
                        //     ->required()
                        //     ->options([
                        //         'Full Time' => 'Full Time',
                        //         'Part Time' => 'Part Time',
                        //         'Internship' => 'Internship'
                        //     ])
                        //     ->grouped()
                        //     ->label(__('Job Type')),

                            Radio::make('job_type')
                            ->required()
                            ->options([
                                'Full Time' => 'Full Time',
                                'Part Time' => 'Part Time',
                                'Internship' => 'Internship'
                            ])->inline()
                            ->inlineLabel(false)
                            ->label(__('Job Type')),

                        ToggleButtons::make('job_location')
                            ->required()
                            ->options([
                                'Metro Manila' => 'Metro Manila',
                                'Cebu' => 'Cebu',
                                'Davao' => 'Davao'
                            ])
                            ->grouped()
                            ->label(__('Job Location')),

                            Select::make('user_id')
                            ->relationship('author', 'name')
                            ->searchable()
                            ->default('3')
                            ->required()
                            ->preload(),

                        Hidden::make('slug')
                            ->required()
                            ->label(__('URL'))
                            ->hint('This is auto-generated.'),


                    ])->columnSpan(1)



            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                TextColumn::make('title')
                    ->searchable()
                    ->label(__('Job Title')),
                // Tables\Columns\TextColumn::make('author.name')
                //     ->searchable()
                //     ->label(__('Posted By')),
                TextColumn::make('date_posted')
                    ->date('D - M d, Y')
                    ->sortable()
                    ->label(__('Date Posted')),
                // TextColumn::make('categories')
                // ->,
                ToggleColumn::make('featured')
                    ->label(__('On Frontpage'))
                    ->sortable()
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->offColor('warning')
                    ->alignCenter(),
                   
                ToggleColumn::make('status')
                    ->label(__('Active'))
                    ->sortable()
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->offColor('warning')
                    ->beforeStateUpdated(function ($record, $state) {
                        // Runs before the state is saved to the database.
                    })
                    ->afterStateUpdated(function ($record, $state) {
                        // Runs after the state is saved to the database.
                    }),
                    ToggleColumn::make('urgent')
                    ->label(__('Urgent'))
                    ->sortable()
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->offColor('warning')
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // CommentsAction::make(),
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
            'index' => Pages\ListJobPosts::route('/'),
            'create' => Pages\CreateJobPost::route('/create'),
            // 'view' => Pages\ViewJobPost::route('/{record}'),
            'edit' => Pages\EditJobPost::route('/{record}/edit'),
        ];
    }
}
