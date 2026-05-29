<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstoqueResource\Pages;
use App\Filament\Resources\EstoqueResource\RelationManagers;
use App\Models\Estoque;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstoqueResource extends Resource
{
    protected static ?string $model = Estoque::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantidade_atual')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

        ->modifyQueryUsing(function (Builder $query) {
            return $query
                ->join('produtos', 'estoques.id_produto', '=', 'produtos.id_produto')
                ->select('estoques.*')
                ->orderBy('produtos.nome', 'asc');
        })
        
        ->columns([
            Tables\Columns\TextColumn::make('id_estoque')
                ->label('ID')
                ->sortable(),

            Tables\Columns\TextColumn::make('produto.nome')
                ->label('Produto')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('quantidade_atual')
                ->label('Quantidade Atual')
                ->sortable(),

            Tables\Columns\TextColumn::make('produto.estoque_minimo')
                ->label('Estoque Mínimo')
                ->sortable(),

            Tables\Columns\TextColumn::make('status_estoque')
                ->label('Status')
                ->badge()
                ->getStateUsing(function ($record) {
                    if (!$record->produto) {
                        return 'Produto não encontrado';
                    }
            
                    if ($record->quantidade_atual <= $record->produto->estoque_minimo) {
                        return 'Estoque Baixo';
                    }
            
                    return 'Normal';
                })
                ->color(function ($state) {
                    return match ($state) {
                        'Estoque Baixo' => 'danger',
                        'Normal' => 'success',
                        default => 'gray',
                    };
                }),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Atualizado em')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->filters([
            //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstoques::route('/'),
            'create' => Pages\CreateEstoque::route('/create'),
            'edit' => Pages\EditEstoque::route('/{record}/edit'),
        ];
    }
}
