<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class MusicalFeatureController extends ModuleController
{
  protected $moduleName = 'musicalFeatures';

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true
  ];
}
