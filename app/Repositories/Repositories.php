<?php

namespace App\Repositories;

class Repositories
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    public function getModelClone()
    {
        return clone $this->model;
    }

}
