<?php

namespace App\Repositories;

use App\Models\Author as Model;
use App\Repositories\Interfaces\IRepository;

class AuthorRepository extends Repositories implements IRepository
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
        $this->getModelClone()->find($id);
    }

    public function getFindOrFail($id)
    {
        return $this->getModelClone()->findOrFail($id);
    }
}
