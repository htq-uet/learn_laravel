<?php

namespace App\Repositories;

abstract class Repository implements RepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    private function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    /**
     * Create
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function findById(int $id)
    {
        return $this->_model->find($id);
    }

    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }


    /**
     * Tìm record đầu tiên theo điều kiện
     * @param array $conditions
     * @param array|string[] $attributes
     * @return array
     */
    public function findFirst(array $conditions, array $attributes = ['*'])
    {
        $query = $this->_model;
        $allow = false;
        $attributes = ! empty($attributes) ? $attributes : ['*'];

        foreach ($conditions as $field => $values) {
            $compareArr = explode(' ', trim($field));
            if (count($compareArr) == 2) {
                $query = $query->where($compareArr[0], $compareArr[1], $values);
                $allow = true;
            } elseif (count($compareArr) == 1) {
                if (is_array($values)) {
                    $query = $query->whereIn($field, $values);
                } else {
                    $query = $query->where($field, $values);
                }
                $allow = true;
            }
        }

        if (! $allow) {
            return [];
        }

        $result = $query->select($attributes)->first();

        if (empty($result)) {
            return [];
        }

        return $result->toArray();
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->_model->updateOrCreate($attributes, $values);
    }

    public function updateAll(array $conditions, array $attributes)
    {
        $query = $this->_model;
        $allow = false;
        foreach ($conditions as $field => $values) {
            $compareArr = explode(' ', trim($field));
            if (count($compareArr) == 2) {
                $query = $query->where($compareArr[0], $compareArr[1], $values);
                $allow = true;
            } elseif (count($compareArr) == 1) {
                if (is_array($values)) {
                    $query = $query->whereIn($field, $values);
                } else {
                    $query = $query->where($field, $values);
                }
                $allow = true;
            }
        }

        if (! $allow) {
            return false;
        }

        return $query->update($attributes);
    }
}
