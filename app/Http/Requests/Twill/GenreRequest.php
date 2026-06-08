<?php

namespace App\Http\Requests\Twill;

use A17\Twill\Http\Requests\Admin\Request;

class GenreRequest extends Request
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
