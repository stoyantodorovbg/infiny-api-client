<?php

namespace App\Repositories;

use App\Data\Interfaces\MassStore;
use App\Data\Interfaces\MassUpdate;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected string $model;

    public function store(MassStore $data): Model
    {
        $model = $this->setPropertiesFromArray($this->newModel(), $data->massStoreFormat());
        $model->save();

        return $model;
    }

    public function update(Model $model, MassUpdate $data): Model
    {
        $model = $this->setPropertiesFromArray($model, $data->massUpdateFormat());
        $model->save();

        return $model;
    }

    public function destroy(Model $model): void
    {
        $this->model::destroy($model->id);
    }

    /**
     * Create Model instance
     *
     * @return Model
     */
    protected function newModel(): Model
    {
        return new $this->model();
    }

    /**
     * Set properties to given model
     *
     * @param Model     $model
     * @param array $data
     * @return Model
     */
    protected function setPropertiesFromArray(Model $model, array $data): Model
    {
        foreach ($data as $column => $value) {
            $model->$column = $value;
        }

        return $model;
    }
}
