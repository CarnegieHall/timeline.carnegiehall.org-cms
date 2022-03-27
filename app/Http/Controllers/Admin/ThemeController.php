<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class ThemeController extends ModuleController
{
  protected $moduleName = 'themes';

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true
  ];
}
