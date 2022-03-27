<?php

namespace App\Twill\Capsules\SiteSettings\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;
use App\Models\Song;
use App\Models\Story;

class SiteSetting extends Model
{
  use HasMedias;

  protected $fillable = [
    'published',
    'title',
    'site_name',
    'seo_stories_title',
    'seo_stories_description',
    'seo_genres_title',
    'seo_genres_description',
    'seo_timeline_title',
    'seo_timeline_description',
    'song_id',
    'stories_index_heading',
    '404_heading',
    '404_cta_message',
    '404_cta_relative_link'
  ];

  public function song()
  {
    return $this->belongsTo(Song::class);
  }

  public function featured_stories()
  {
    return $this->belongsToMany(Story::class, 'featured_stories')->withPivot('story_id')->orderBy('featured_stories.position');
  }
}
