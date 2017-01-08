<?php

namespace App\Actions;

use Illuminate\Foundation\Application;
use ReflectionClass;
use Illuminate\Contracts\Validation\Factory;

class ManagerActions
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var array
     */
    protected $actions_queue;

    /**
     * ManagerActions constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->errors = [];

        $this->actions_queue = [];
    }

    /**
     * Adiciona uma action na fila de execução
     *
     * @param string $class
     * @param array $data
     */
    public function add(string $class, array $data)
    {
        $this->actions_queue[] = [
            'class' => $class,
            'data' => $data
        ];
    }

    /**
     * Executa as actions adicionandas na fila
     *
     * @return bool
     */
    public function run()
    {
        foreach ($this->actions_queue as $action_queue) {

            $action = $this->buildAction($action_queue['class'], $action_queue['data']);

            $validator = $this->app->make(Factory::class)->make($action->data(), $action->rules(), $action->messages());

            $passes = $validator->passes();

            $this->errors = array_merge($this->errors, $validator->errors()->messages());

            if ($passes) {

                $action->run();
                continue;
            }

            return false;
        }

        return true;
    }

    private function buildAction(string $class, array $data): BaseAction
    {
        $action_reflected = new ReflectionClass($class);

        return $action_reflected->newInstance($data);
    }

    public function errors()
    {
        return $this->errors;
    }
}