<?php

namespace App\Repositories;

use App\Models\Book as Model;
use App\Repositories\Interfaces\IRepository;

class BookRepository extends Repositories implements IRepository
{
    public function getModel() : string
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->getModelClone()->all();
    }

    public function findById(int $id)
    {
        return $this->getModelClone()->find($id);
    }

    public function getFindOrFail($id)
    {
        return $this->getModelClone()->findOrFail($id);
    }
}
