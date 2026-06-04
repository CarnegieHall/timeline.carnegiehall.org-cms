<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

class HeroFeaturedContent extends Model implements Sortable
{
    use HasMedias, HasRevisions, HasPosition, HasFactory, HasRelated;

    protected $fillable = [
        'published',
        'homepage_id',
        'title',
        'subtitle',
        'destination',
        'related_page_id',
        'related_page_type',
        'related_story_id',
        'related_story_type',
        'related_notablePerformer_id',
        'related_notablePerformer_type',
        'related_genre_id',
        'related_genre_type',
        'external_link',
        'main_color',
        'position',
    ];
    public $mediasParams = [
        'hero_image' => [
            'default' => [
                [
                    'name' => 'default'
                ]
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1
                ]
            ]
        ]
    ];
    public function related_page()
    {
        return $this->morphTo();
    }
    public function related_story()
    {
        return $this->morphTo();
    }
    public function related_notablePerormer()
    {
        return $this->morphTo();
    }
    public function related_genre()
    {
        return $this->morphTo();
    }

}
