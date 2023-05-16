<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Searchable.
 * @package App\Traits.
 */
trait Searchable
{
    /**
     * @param Builder $builder
     * @param $request
     * @return Builder.
     */
    public function search(Builder $builder, $request)
    {
        $searchtableFields = collect($this->searchableAttrs);

        $searchtableFields->map(function($operator, $field) use ($builder, $request) {
            if($request->get($field)) {

                if(!is_array($operator)) {
                    $builder = $this->queryField($operator, $field, $request->get($field), $builder);
                } else {
                    $fieldFilter = collect($operator);
                    $fieldFilter->map(function($operator, $field) use ($builder, $request) {
                        $relationAttr = explode('.', $field);

                        $builder->whereHas($relationAttr[0], function($query) use ($relationAttr, $request, $operator) {
                            $this->queryField($operator, $relationAttr[1], $request->get($relationAttr[0]), $query);
                        });

                    });
                }
            }
        });

        return $builder;
    }

    /**
     * @param $operator
     * @param $field
     * @param $value
     * @param Builder $builder
     * @return Builder
     */
    private function queryField($operator, $field, $value, Builder $builder)
    {
        switch ($operator) {
            case '=':
                return $builder->where($field, $operator, $value);
            case 'like':
                return $builder->where($field, $operator, '%' . $value . '%');
            case 'beetwen':
                return $builder->whereBeetwen($field, $value);
            case 'in':
                return is_array($value) ? $builder->whereIn($field, $value) : $builder->whereIn($field, [$value]);
            default:
                return $builder->where($field, $value);
        }
    }
}
