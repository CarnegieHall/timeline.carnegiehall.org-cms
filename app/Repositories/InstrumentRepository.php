<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\Instrument;

class InstrumentRepository extends ModuleRepository
{
  public function __construct(Instrument $model)
  {
    $this->model = $model;
  }
}
