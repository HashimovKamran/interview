<?php

namespace App\Persistence\Repositories;

use App\Application\Services\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\{Model, Collection};

abstract class Repository implements RepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function all(): Collection
    {
        return $this->model->all();
    }
}
