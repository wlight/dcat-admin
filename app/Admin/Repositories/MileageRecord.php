<?php

namespace App\Admin\Repositories;

use App\Models\MileageRecord as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MileageRecord extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
