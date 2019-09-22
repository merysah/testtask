<?php

namespace App\Repositories;

class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate()
    {
        return $this->model->paginate(5);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}

?>