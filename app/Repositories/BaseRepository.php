<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    protected $model;
    protected Builder $builder;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->builder = $model->newQuery();
    }

    public function newQuery()
    {
        $this->builder = $this->model->newQuery();
        return $this;
    }

    public function get($columns = ['*'])
    {
        return $this->builder->get($columns);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function chunk(int $count, callable $callback): bool
    {
        return $this->builder->chunk($count, $callback);
    }

    public function with(array $with = [])
    {
        $this->builder->with($with);
        return $this;
    }

}
