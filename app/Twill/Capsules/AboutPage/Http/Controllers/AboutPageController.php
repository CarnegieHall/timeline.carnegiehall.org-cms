<?php

namespace App\Twill\Capsules\AboutPage\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Twill\Capsules\AboutPage\Repositories\AboutPageRepository;

class AboutPageController extends ModuleController
{
  protected $moduleName = 'aboutPage';

  protected $defaultIndexOptions = [
    'create' => true,
    'edit' => true,
    'publish' => true,
    'bulkPublish' => true,
    'feature' => false,
    'bulkFeature' => false,
    'restore' => true,
    'bulkRestore' => true,
    'forceDelete' => true,
    'bulkForceDelete' => true,
    'delete' => true,
    'duplicate' => false,
    'bulkDelete' => true,
    'reorder' => false,
    'permalink' => false,
    'bulkEdit' => false,
    'editInModal' => false,
    'skipCreateModal' => false,
  ];

  public function landing(AboutPageRepository $entries)
  {
    return view(
      $this->getViewPrefix() . '.form',
      $this->form($entries->getAboutPage()->id),
    );
  }

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
