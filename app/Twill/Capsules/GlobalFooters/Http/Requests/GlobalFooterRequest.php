<?php

namespace App\Twill\Capsules\GlobalFooters\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;

class GlobalFooterRequest extends Request
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
