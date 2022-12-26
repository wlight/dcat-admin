<?php

namespace App\Admin\Repositories;

use App\Models\Mileage as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Mileage extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
