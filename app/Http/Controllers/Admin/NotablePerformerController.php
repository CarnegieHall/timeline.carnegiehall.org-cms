<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class NotablePerformerController extends ModuleController
{
  protected $moduleName = 'notablePerformers';
  protected $titleColumnKey = 'name';
  protected $titleFormKey = 'name';

  protected $indexColumns = [
    'image' => [
      'thumb' => true, // image column
      'variant' => [
        'role' => 'image',
        'crop' => 'default',
      ],
    ],
    'name' => [ // field column
      'title' => 'Name',
      'field' => 'name',
    ],
  ];
}
