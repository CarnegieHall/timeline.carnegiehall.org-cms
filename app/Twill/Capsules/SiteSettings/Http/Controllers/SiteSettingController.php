<?php

namespace App\Twill\Capsules\SiteSettings\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Twill\Capsules\SiteSettings\Repositories\SiteSettingRepository;

class SiteSettingController extends ModuleController
{
  protected $moduleName = 'siteSettings';

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

  public function landing(SiteSettingRepository $entries)
  {
    return view(
      $this->getViewPrefix() . '.form',
      $this->form($entries->getSiteSettings()->id),
    );
  }

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
