<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class SongController extends ModuleController
{
  protected $moduleName = 'songs';
  protected $defaultFilters = ['search' => 'title|performer|search'];

  protected $indexOptions = [
    'permalink' => false
  ];

  /*
     * Available columns of the index view
     */
  protected $indexColumns = [
    'title' => [ // field column
      'title' => 'Title',
      'field' => 'title',
    ],
    'artist' => [ // relation column
      // Take a look at the example in the next section fot the implementation of the sort
      'title' => 'Performer',
      'field' => 'artist',
      'visible' => true
    ],
    'id' => [ // field column
      'title' => 'ID',
      'field' => 'id',
    ]
  ];

  /*
     * Columns of the browser view for this module when browsed from another module
     * using a browser form field
     */
  protected $browserColumns = [
    'title' => [
      'title' => 'Title',
      'field' => 'title',
    ]
  ];

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
