<?php

namespace App\Http\Controllers\Twill;


use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class HeroFeaturedContentController extends BaseModuleController
{
    protected $moduleName = 'heroFeaturedContents';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
    }

}
