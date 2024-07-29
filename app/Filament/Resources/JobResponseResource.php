<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResponseResource\Pages;
use App\Filament\Resources\JobResponseResource\RelationManagers;
use App\Models\JobResponse;
use App\ResponseStatus;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class JobResponseResource extends Resource
{
    protected static ?string $model = JobResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationGroup = 'Form Inquiries';

    protected static ?string $navigationLabel = 'Job Inquiries';

    protected static ?int $navigationSort = 3;

    protected static ?string $label = 'Job Inquiries';

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
                        Select::make('post_title')
                            ->relationship('job_post', 'title')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label(__('Position'))
                            ->columnSpan(2),
                        TextInput::make('full_name')
                            ->required()
                            ->label(__('Full Name'))
                            ->live(onBlur: true)
                            ->hint('  ')
                            ->columnSpan(2),
                        // Radio::make('status')->options(ResponseStatus::class),
                        TextInput::make('email_address')
                            ->email()
                            ->label(__('Email Address'))
                            ->columnSpan(1),
                        TextInput::make('contact')
                            ->tel()
                            ->maxLength(11)
                            ->label(__('Contact Number'))
                            ->columnSpan(1),

                        TextInput::make('current_address')
                            ->columnSpan(2)
                            ->required()
                            ->label(__('Current Address'))
                            ->hint('#/Street'),

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
                        FileUpload::make('attachment')
                            ->uploadingMessage('Uploading attachment...')
                            ->directory('form-attachments')
                            ->visibility('public')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(5120)
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend('job_response'),
                            )
                            ->openable()
                            ->downloadable()
                            ->fetchFileInformation(true)
                            ->moveFiles()
                            ->storeFiles(true)
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            // ->required()
                            ->columnSpanFull()
                            ->id('attachment'),

                    ])->columnSpan(1),


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('created_at')
                ->since()
                ->dateTimeTooltip()
                ->sortable()
                ->label('Date'),
                // TextColumn::make('date_response')
                //     ->date()
                //     ->sortable()
                //     ->label(__('Date'))
                //     ->alignCenter(),
                TextColumn::make('full_name')
                    ->searchable()
                    ->label(__('Name'))
                    ->alignCenter(),
                TextColumn::make('job_post.title')
                    ->label(__('Position'))
                    ->sortable()
                    ->alignCenter(),
                IconColumn::make('attachment')
                    ->grow(false)
                    ->label(' ')
                    ->icon('heroicon-o-link')
                    ->wrap()
                    ->alignCenter(),
                IconColumn::make('review')
                    ->boolean()
                    ->label('Reviewed')
                    ->sortable()
                    ->alignCenter(),
                SelectColumn::make('status')
                    // ->options(ResponseStatus::class)
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->searchable()
                    ->grow(false)
                    ->alignCenter()
                    ->options([
                        'pending' => 'pending',
                        'cancelled' => 'cancelled',
                        'hired' => 'hired',
                        'unqualified' => 'unqualified',
                    ])
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state === 'cancelled' || 'hired' || 'unqualified') {
                            $record->review = true;
                            $record->save();
                        }
                    }),

            ])->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->heading('Job Form Responses')
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
                            ->withFilename(date(Carbon::now()) . ' - Job Application Responses')
                            ->withColumns([
                                Column::make('date_response')
                                    ->heading('Date of Application'),
                                Column::make('full_name')
                                    ->heading('Name of Applicant'),
                                Column::make('job_post.title')
                                    ->heading('Position Applied'),
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
            ]);;
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
            'index' => Pages\ListJobResponses::route('/'),
            'create' => Pages\CreateJobResponse::route('/create'),
            // 'view' => Pages\ViewJobResponse::route('/{record}'),
            'edit' => Pages\EditJobResponse::route('/{record}/edit'),
        ];
    }
}
