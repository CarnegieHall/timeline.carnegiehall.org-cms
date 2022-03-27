<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\MusicalFeature;

class MusicalFeatureRepository extends ModuleRepository
{
  public function __construct(MusicalFeature $model)
  {
    $this->model = $model;
  }
}
