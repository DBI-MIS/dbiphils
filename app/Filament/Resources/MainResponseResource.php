<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainResponseResource\Pages;
use App\Filament\Resources\MainResponseResource\RelationManagers;
use App\Models\MainResponse;
use Filament\Forms;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Forms';

    protected static ?string $navigationLabel = 'Responses';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                Select::make('subject')
                ->options([
                    'General Inquiry' => 'General Inquiry',
                    'Product Inquiry' => 'Product Inquiry',
                    'Concern/Issue' => 'Concern/Issue',
                    'Careers/Hiring' => 'Careers/Hiring',
                    'Feedback' => 'Feedback',
                ])->default('General Inquiry'),
                TextInput::make('contact')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('review')
                    ->hidden()
                    ->default(false),
                Select::make('status')
                    ->options([
                        'pending' => 'pending',
                        'reviewed' => 'reviewed',
                    ])->default('pending')->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListMainResponses::route('/'),
            'create' => Pages\CreateMainResponse::route('/create'),
            'edit' => Pages\EditMainResponse::route('/{record}/edit'),
        ];
    }
}
