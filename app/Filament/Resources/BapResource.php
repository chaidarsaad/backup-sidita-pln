<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BapResource\Pages;
use App\Filament\Resources\BapResource\RelationManagers;
use App\Models\Bap;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class BapResource extends Resource
{
    public static function getNavigationLabel(): string
    {
        return 'BA Pembayaran';
    }


    protected static ?string $model = Bap::class;
    protected static ?int $navigationSort = 5;

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
                Forms\Components\DatePicker::make('date_created')
                    ->required(),
                Forms\Components\Toggle::make('is_approve')
                    ->accepted()
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
                $query->orderBy('name', 'desc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListBaps::route('/'),
            // 'create' => Pages\CreateBap::route('/create'),
            // 'edit' => Pages\EditBap::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
