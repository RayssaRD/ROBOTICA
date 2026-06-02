<?php

namespace App\Filament\Resources\EstoqueResource\Pages;

use App\Filament\Resources\EstoqueResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditEstoque extends EditRecord
{
    protected static string $resource = EstoqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $estoque = $this->record;

        if ($estoque->produto && $estoque->quantidade_atual <= $estoque->produto->estoque_minimo) {
            Notification::make()
                ->title('Estoque abaixo do esperado')
                ->body('O produto "' . $estoque->produto->nome . '" está com quantidade atual abaixo ou igual ao estoque mínimo.')
                ->danger()
                ->send();
        } else {
            Notification::make()
                ->title('Estoque atualizado')
                ->body('A quantidade do estoque foi atualizada com sucesso.')
                ->success()
                ->send();
        }
    }
}