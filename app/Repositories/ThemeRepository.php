<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\Theme;

class ThemeRepository extends ModuleRepository
{
  public function __construct(Theme $model)
  {
    $this->model = $model;
  }
}
