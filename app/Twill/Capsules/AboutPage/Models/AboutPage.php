<?php

namespace App\Twill\Capsules\AboutPage\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class AboutPage extends Model
{
  use HasBlocks, HasMedias;

  protected $table = 'about_page';

  protected $fillable = [
    'published',
    'title',
  ];

  public $mediasParams = [
    'default' => [
      'default' => [
        [
          'name' => 'default'
        ],
      ],
    ],
  ];
}
