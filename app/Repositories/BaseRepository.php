<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;

/**
 * Class BaseRepository.
 * @package App\Repositories.
 */
abstract class BaseRepository
{
    /**
     * Model class
     *
     * @var string
     */
    protected $modelClass;

    /**
     * @return mixed
     */
    protected function newQuery()
    {
        return app($this->modelClass);
    }

    /**
     * @param EloquentQueryBuilder|QueryBuilder $query
     * @param int                               $take
     * @param bool                              $paginate
     *
     * @return EloquentCollection|Paginator
     */
    protected function doQuery($query = null, $take = 15, $paginate = true, $with = [])
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if(count($with) > 0) {
            $query = $query->with($with);
        }

        if (true == $paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || false !== $take) {
            $query->take($take);
        }
        return $query->get();
    }

    /**
     * @return mixed.
     */
    public function model()
    {
        return $this->newQuery();
    }

    /**
     * Define a relations.
     * @param array $with
     * @return $this
     */
    public function with(array $with)
    {
        $this->newQuery()->with($with);

        return $this;
    }

    /**
     * Returns all records.
     * If $take is false then brings all records
     * If $paginate is true returns Paginator instance.
     *
     * @param int  $take
     * @param bool $paginate
     *
     * @return EloquentCollection|Paginator
     */
    public function all($take = 15, $paginate = true, $with = [])
    {
        return $this->doQuery(null, $take, $paginate, $with);
    }

    /**
     * @return EloquentCollection|Paginator.
     */
    public function get()
    {
        return $this->doQuery(null, false, false);
    }

    /**
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection
     */
    public function lists($column, $key = null)
    {
        return $this->newQuery()->lists($column, $key);
    }

    /**
     * Retrieves a record by his id
     * If fail is true $ fires ModelNotFoundException.
     *
     * @param int  $id
     * @param bool $fail
     *
     * @return Model.
     */
    public function findById($id, $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }

        return $this->newQuery()->find($id);
    }


    /**
     * Returns a record by slug.
     *
     * @param $slug
     * @return Model.
     */
    public function findBySlug($slug)
    {
        return $this->newQuery()->where('slug', $slug);
    }

    /**
     * @param $field
     * @param array $values
     * @return mixed
     */
    public function whereIn($field, array $values)
    {
        return $this->newQuery()->whereIn($field, $values);
    }

    /**
     * @param $field
     * @param array $values
     * @return mixed.
     */
    public function whereNotIn($field, array $values)
    {
        return $this->newQuery()->whereNotIn($field, $values);
    }

    /**
     * @param $field
     * @param $value
     * @return mixed.
     */
    public function where($field, $value)
    {
        return $this->newQuery()->where($field, $value);
    }

    /**
     * Create a new record of this model.
     *
     * @param $data
     * @return Model.
     */
    public function create($data)
    {
        return $this->newQuery()->create($data);
    }

    /**
     * Update a record
     * @param int $id
     * @param array $data
     * @return Model.
     */
    public function update($id, $data)
    {
        $this->newQuery()->where('id', $id)->update($data);

        return $this->findById($id);
    }

    /**
     * @param $model
     * @param $relation
     * @param $ids
     * @return mixed
     */
    public function detach($model, $relation, $ids)
    {
        return $model->{$relation}()->sync($ids);
    }

    /**
     * @param $slug
     * @param $data
     * @return mixed
     */
    public function updateBySlug($slug, $data)
    {
        $this->newQuery()->whereNull('deleted_at')->where('slug', $slug)->update($data);

        return $this->newQuery()->slug($slug);
    }

    /**
     *
     * Delete a record.
     *
     * @param int $id
     * @return Model.
     */
    public function delete($id)
    {
        return $this->newQuery()->where('id', $id)->delete();
    }

    /**
     * Delete a record by slug.
     *
     * @param string $slug
     * @return mixed.
     */
    public function deleteBySlug($slug)
    {
        return $this->newQuery()->slug($slug)->delete();
    }
}
