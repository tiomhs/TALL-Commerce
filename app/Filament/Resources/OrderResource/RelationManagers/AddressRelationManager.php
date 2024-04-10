<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                TextInput::make('city')
                    ->required()
                    ->maxLength(225),

                TextInput::make('state')
                    ->required()
                    ->maxLength(225),

                TextInput::make('zip_code')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                Textarea::make('street_address')
                    ->required()
                    ->columnSpanFull(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->label("Full Name"),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('zip_code'),
                Tables\Columns\TextColumn::make('street_address'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
