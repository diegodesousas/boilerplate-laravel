<?php

namespace App\Actions\Author;

use App\Actions\Helpers\CrudActions\CreateAction as CrudCreateAction;
use App\Model\Author;

class CreateAction extends CrudCreateAction
{
    public function rules(): array
    {
        return [
            'author.name' => ['required']
        ];
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
     * Deve retornar a classe do modelo
     *
     * @return string
     */
    protected function modelClass(): string
    {
        return Author::class;
    }
}