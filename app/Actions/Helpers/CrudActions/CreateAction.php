<?php

namespace App\Actions\Helpers\CrudActions;

abstract class CreateAction extends BaseCrudAction
{
    /**
     * Lógica de persistência de um modelo
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function run()
    {
        $this->model->fill($this->fillableData());

        $this->model->save();

        return $this->model;
    }
}