<?php

namespace App\Actions;

use Illuminate\Support\Arr;

abstract class BaseAction
{
    /**
     * @var array
     */
    protected $data;

    /**
     * BaseAction constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public abstract function rules(): array;

    public abstract function run();

    public function messages(): array
    {
        return [];
    }

    public function data(): array
    {
        return $this->data;
    }

    /**
     * Recupera valores do atributo data
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->data, $key, $default);
    }
}