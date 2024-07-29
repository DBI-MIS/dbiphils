<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainResponseResource\Pages;
use App\Filament\Resources\MainResponseResource\RelationManagers;
use App\Models\MainResponse;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

class MainResponseResource extends Resource
{
    protected static ?string $model = MainResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Form Inquiries';

    protected static ?string $navigationLabel = 'General Inquiries';
    
    protected static ?string $label = 'Form Inquiries';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Response')
                    ->description(' ')
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Textarea::make('message')
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                        Toggle::make('review')
                            ->hidden()
                            ->default(false),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        Select::make('subject')
                            ->options([
                                'General Inquiry' => 'General Inquiry',
                                'Product Inquiry' => 'Product Inquiry',
                                'Concern/Issue' => 'Concern/Issue',
                                'Careers/Hiring' => 'Careers/Hiring',
                                'Feedback' => 'Feedback',
                            ])->default('General Inquiry'),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('contact')
                            ->required(),

                    ])->columnSpan(1),
                Select::make('status')
                    ->options([
                        'pending' => 'pending',
                        'reviewed' => 'reviewed',
                    ])->default('pending')->hidden(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                ->since()
                ->dateTimeTooltip()
                ->label('Date'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('contact')
                    ->searchable(),
                IconColumn::make('review')
                    ->boolean(),
                SelectColumn::make('status')
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
            ])->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMainResponses::route('/'),
            'create' => Pages\CreateMainResponse::route('/create'),
            'edit' => Pages\EditMainResponse::route('/{record}/edit'),
        ];
    }
}
