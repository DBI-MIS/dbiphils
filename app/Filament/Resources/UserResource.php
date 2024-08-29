<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use DiscoveryDesign\FilamentGaze\Forms\Components\GazeBanner;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 20;

    protected $casts = [
        'password' => 'hashed',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        GazeBanner::make()
                        ->lock()
                        ->canTakeControl()
                        ->hideOnCreate()
                        ->columnSpanFull(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->password()
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)),
                    ])->columnSpan(2),
                Section::make(' ')
                    ->description(' ')
                    ->schema([
                        Select::make('role')
                            ->options(User::ROLES)
                            ->required(),
                    ])->columnSpan(1),




            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable(),
                // ToggleColumn::make('role')
                //     ->label(__('Admin'))
                //     ->sortable()
                //     ->beforeStateUpdated(function ($record, $state) {
                //         // Runs before the state is saved to the database.
                //     })
                //     ->afterStateUpdated(function ($record, $state) {
                //         // Runs after the state is saved to the database.
                //     }),
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
