<?php

namespace App\Repositories;

use Closure;
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

    /**
     * @return $this
     */
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

    /**
     * @param array $with
     * @return $this
     */
    public function with(array $with = [])
    {
        $this->builder->with($with);
        return $this;
    }

    /**
     * @param string[] $columns
     * @return $this
     */
    public function select($columns = ['*'])
    {
        $this->builder->select($columns = ['*']);
        return $this;
    }

    /**
     * @param string $expression
     * @param array $bindings
     * @return $this
     */
    public function selectRaw(string $expression, array $bindings = [])
    {
        $this->builder->selectRaw($expression, $bindings = []);
        return $this;
    }

    /**
     * @param  string  $table
     * @param  Closure|string  $first
     * @param  string|null  $operator
     * @param  string|null  $second
     * @param  string  $type
     * @param  bool  $where
     * @return $this
     */
    public function join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        $this->builder->join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false);
        return $this;
    }

    /**
     * @param  array|string  ...$groups
     * @return $this
     */
    public function groupBy($groups)
    {
        $this->builder->groupBy($groups);
        return $this;
    }

    /**
     * @param $sql
     * @param array $bindings
     * @param string $boolean
     * @return $this
     */
    public function havingRaw($sql, array $bindings = [], $boolean = 'and')
    {
        $this->builder->havingRaw($sql, $bindings, $boolean);
        return $this;
    }

    /**
     * @param  string  $sql
     * @param  mixed  $bindings
     * @param  string  $boolean
     * @return $this
     */
    public function whereRaw($sql, $bindings = [], $boolean = 'and')
    {
        $this->builder->whereRaw($sql, $bindings = [], $boolean = 'and');
        return $this;
    }

}
