<?php

namespace App\Actions\Helpers\CrudActions;

abstract class UpdateAction extends CreateAction
{
    /**
     * Lógica de persistência de um modelo
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function run()
    {
        $this->model->find($this->modelId())->update($this->fillableData());

        return $this->model;
    }

    /**
     * Deve retornar o id do modelo que será atualizado
     *
     * @return int
     */
    public abstract function modelId(): int;
}