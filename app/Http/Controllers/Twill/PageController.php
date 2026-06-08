<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PageController extends ModuleController
{
  protected $moduleName = 'pages';

  protected $previewView = 'site.page';

  protected $indexOptions = [
    'reorder' => true,
  ];

  protected $showOnlyParentItemsInBrowsers = true;

  protected $nestedItemsDepth = 1;
}
