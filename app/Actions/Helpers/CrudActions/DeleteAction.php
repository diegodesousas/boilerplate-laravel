<?php

namespace App\Actions\Helpers\CrudActions;

abstract class DeleteAction extends BaseCrudAction
{
    public function run()
    {
        $this->find()->delete();
    }

    /**
     * Deve retornar o id do modelo que será atualizado
     *
     * @return int
     */
    public abstract function modelId(): int;

    /**
     * Busca um registro do modelo pelo id informado
     *
     * @return mixed
     */
    public function find()
    {
        return $this->model->find($this->modelId());
    }
}