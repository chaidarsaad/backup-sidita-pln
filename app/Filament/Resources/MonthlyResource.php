<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\LaporanProgres;
use App\Filament\Resources\MonthlyResource\Pages;
use App\Filament\Resources\MonthlyResource\RelationManagers;
use App\Models\Monthly;
use App\Filament\Clusters\Weekly;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonthlyResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Progres Bulanan';
    }

    protected static ?string $model = Monthly::class;
    protected static ?string $cluster = LaporanProgres::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rencana')
                    ->required()
                    ->numeric()
                    ->suffix('%'),
                Forms\Components\TextInput::make('aktual')
                    ->required()
                    ->numeric()
                    ->suffix('%'),
                Forms\Components\TextInput::make('deviasi')
                    ->required()
                    ->numeric()
                    ->suffix('%'),
                Forms\Components\DatePicker::make('date_created')
                    ->required(),
                Forms\Components\Toggle::make('is_approve')
                    ->required(),
                Forms\Components\DatePicker::make('date_approved')
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                    ->previewable(true)
                    ->acceptedFileTypes(['application/pdf']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->orderBy('date_created', 'desc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rencana')
                    ->label('Rencana (%)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('aktual')
                    ->label('Aktual (%)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deviasi')
                    ->label('Deviasi (%)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_created')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_approve')
                    ->boolean(),
                Tables\Columns\TextColumn::make('date_approved')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListMonthlies::route('/'),
            // 'create' => Pages\CreateMonthly::route('/create'),
            // 'edit' => Pages\EditMonthly::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
