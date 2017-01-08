<?php

namespace App\Actions\Helpers\CrudActions;

use App\Actions\BaseAction;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

abstract class BaseCrudAction extends BaseAction
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->model = $this->buildModel($this->modelClass());
    }

    /**
     * Dados para preencimento do objeto do modelo
     *
     * @return array
     */
    protected function fillableData(): array
    {
        return $this->data();
    }

    /**
     * @param $model_class
     * @return Model
     */
    protected function buildModel($model_class)
    {
        $reflected_model = new ReflectionClass($model_class);

        return $reflected_model->newInstance();
    }

    /**
     * Deve retornar a classe do modelo
     *
     * @return string
     */
    protected abstract function modelClass(): string;
}