<?php

namespace App\Actions\Author;

use App\Actions\Helpers\CrudActions\DeleteAction as CrudDeleteAction;
use App\Model\Author;

class DeleteAction extends CrudDeleteAction
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
     * Deve retornar o id do modelo que será atualizado
     *
     * @return int
     */
    public function modelId(): int
    {
        return $this->get('author.id');
    }

    public function run()
    {
        $this->find()->books()->detach();

        parent::run();
    }
}