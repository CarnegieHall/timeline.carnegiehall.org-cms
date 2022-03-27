<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class NotablePerformer extends Model
{

  use HasMedias;

  protected $fillable = [
    'published',
    'name',
    'attribution'
  ];

  public $checkboxes = [
    'published'
  ];

  public $mediasParams = [
    'image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ],
      'mobile' => [
        [
          'name' => 'mobile',
          'ratio' => 1,
        ],
      ],
    ],
  ];

  protected $browserColumns = [
    'title' => [
      'title' => 'Title',
      'field' => 'title',
    ],
  ];

  public function getTitleAttribute()
  {
    return $this->name;
  }

  public function songs()
  {
    return $this->hasMany(Song::class);
  }
}
