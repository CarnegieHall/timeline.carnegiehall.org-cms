<?php

namespace App\Twill\Capsules\SiteSettings\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;

class SiteSettingRequest extends Request
{
  public function rulesForCreate()
  {
    return [];
  }

  public function rulesForUpdate()
  {
    return [];
  }
}
