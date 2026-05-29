<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produtos';

    protected static ?string $modelLabel = 'Produto';

    protected static ?string $pluralModelLabel = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('codigo')
                    ->label('Código')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('marca')
                    ->label('Marca')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('fabricante_fornecedor')
                    ->label('Fabricante / Fornecedor')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('numero_serie')
                    ->label('Número de Série')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Este número de série já está cadastrado. Tente Novamente.',
                    ])
                    ->maxLength(15),

                Forms\Components\TextInput::make('compatibilidade_robo')
                    ->label('Compatibilidade com o Robô')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('vida_util_hr')
                    ->label('Vida útil (em horas)')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Forms\Components\TextInput::make('estoque_minimo')
                    ->label('Estoque Mínimo')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                    
                Forms\Components\Select::make('id_usuario')
                    ->label('Usuário Responsável')
                    ->relationship('usuario', 'nome')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('nome', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('id_produto')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable(),

                Tables\Columns\TextColumn::make('fabricante_fornecedor')
                    ->label('Fabricante / Fornecedor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('numero_serie')
                    ->label('Número de Série'),
                
                Tables\Columns\TextColumn::make('compatibilidade_robo')
                    ->label('Compatibilidade com o Robô')
                    ->sortable(),
                
                    Tables\Columns\TextColumn::make('vida_util_hr')
                    ->label('Vida útil (em horas)')
                    ->searchable(),


                Tables\Columns\TextColumn::make('estoque_minimo')
                    ->label('Estoque Mínimo')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}