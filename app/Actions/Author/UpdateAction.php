<?php

namespace App\Actions\Author;

use App\Actions\Helpers\CrudActions\UpdateAction as CrudUpdateAction;
use App\Model\Author;

class UpdateAction extends CrudUpdateAction
{
    public function rules(): array
    {
        return [
            'author.id' => ['required', 'exists:authors,id']
        ];
    }

    /**
     * Deve retornar a classe do modelo
     *
     * @return string
     */
    protected function modelClass(): string
    {
        return Author::class;
    }

    /**
     * Dados para preencimento do objeto do modelo
     *
     * @return array
     */
    public function fillableData(): array
    {
        return $this->get('author');
    }

    /**
     * Deve retornar o id do modelo que será atualizado
     *
     * @return int
     */
    public function modelId(): int
    {
        return $this->get('author.id');
    }
}