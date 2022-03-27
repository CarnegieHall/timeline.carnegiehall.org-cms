<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class AuthorController extends ModuleController
{
  protected $moduleName = 'authors';
  protected $perPage = 120;
  protected $defaultOrders = ['position' => 'desc'];

  protected $indexColumns = [
    'title' => [ // field column
      'title' => 'Title',
      'field' => 'title',
    ],
  ];

  protected $defaultFilters = ['search' => 'name'];

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true,
    'skipCreateModal' => false,
    'reorder' => true
  ];

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
