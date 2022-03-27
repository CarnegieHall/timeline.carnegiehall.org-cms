<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;
use Illuminate\Support\Facades\DB;

class Story extends Model
{
  use HasSlug, HasMedias, HasBlocks, HasFiles, HasPosition;

  protected $fillable = [
    'title',
    'published',
    'year_start',
    'year_finish',
    'seo_title',
    'seo_description',
    'hero_image_attribution',
    'position',
    'song_id',
    'author_id',
    'color',
    'citation'
  ];

  public $slugAttributes = [
    'title'
  ];

  public $checkboxes = [
    'published'
  ];

  public $mediasParams = [
    'hero_image' => [
      'default' => [
        [
          'name' => 'default'
        ],
      ],
      'mobile' => [
        [
          'name' => 'mobile',
          'ratio' => 1,
        ],
      ],
    ],
    'seo_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ]
  ];

  public $filesParams = ['video'];

  /**
   * This is a duplicate of the method on HasSlug.
   */
  public function getExistingSlug($slugParams)
  {
    $query = DB::table($this->getSlugsTable())->where($this->getForeignKey(), $this->id);
    unset($slugParams['active']);

    foreach ($slugParams as $key => $value) {
      //check variations of the slug
      if ($key == 'slug') {
        $query->where(function ($query) use ($value) {
          $query->orWhere('slug', $value);
          $query->orWhere('slug', $value . '-' . $this->getSuffixSlug());
          /*
          * Lets remove this so that we have have an original URL without a variation
          */
          // for ($i = 2; $i <= $this->nb_variation_slug; $i++) {
          //   $query->orWhere('slug', $value . '-' . $i);
          // }
        });
      } else {
        $query->where($key, $value);
      }
    }

    return $query->first();
  }


  public function genres()
  {
    return $this->belongsToMany(Genre::class);
  }

  public function authors()
  {
    // return $this->belongsToMany(Author::class, 'story_author', 'story_id');
    return $this->belongsToMany(Author::class, 'story_author', 'story_id')
      ->withPivot(['position'])
      ->orderBy('pivot_position', 'asc');
  }

  public function song()
  {
    return $this->belongsTo(Song::class);
  }
}
