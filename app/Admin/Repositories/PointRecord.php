<?php

namespace App\Admin\Repositories;

use App\Models\PointRecord as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PointRecord extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
