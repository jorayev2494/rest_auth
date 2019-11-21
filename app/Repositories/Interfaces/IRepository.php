<?php

namespace App\Repositories\Interfaces;

interface IRepository
{
    public function getModel() : string;
    public function getAll();
    public function findById(int $id);
}
