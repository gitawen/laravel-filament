<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('€')
                    ->maxValue(42949672.95),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                    Tables\Columns\TextColumn::make('description'),
                    Tables\Columns\TextColumn::make('price')
                        ->money('EUR')
                        ->sortable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime(),
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
