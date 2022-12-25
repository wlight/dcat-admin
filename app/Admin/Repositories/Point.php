<?php

namespace App\Admin\Repositories;

use App\Models\Point as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Point extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
