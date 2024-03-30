<?php

namespace App\Repositories\Interfaces;

use App\Data\Interfaces\MassStore;
use App\Data\Interfaces\MassUpdate;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Create and store Model
     *
     * @param MassStore $data
     * @return Model
     */
    public function store(MassStore $data): Model;

    /**
     * Update given Model
     *
     * @param Model     $model
     * @param MassUpdate $data
     * @return Model
     */
    public function update(Model $model, MassUpdate $data): Model;
}
