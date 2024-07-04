<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\LaporanProgres;
use App\Filament\Resources\WeeklyResource\Pages;
use App\Filament\Resources\WeeklyResource\RelationManagers;
use App\Models\Weekly;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeeklyResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'Progres Mingguan';
    }

    protected static ?int $navigationSort = 1;

    protected static ?string $model = Weekly::class;
    protected static ?string $cluster = LaporanProgres::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $activeNavigationIcon = 'heroicon-s-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('progress')
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
                Tables\Columns\TextColumn::make('progress')
                    ->label('Progres (%)')
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
            'index' => Pages\ListWeeklies::route('/'),
            // 'create' => Pages\CreateWeekly::route('/create'),
            // 'edit' => Pages\EditWeekly::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
