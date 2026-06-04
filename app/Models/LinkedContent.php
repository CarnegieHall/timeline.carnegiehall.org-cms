<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

class LinkedContent extends Model implements Sortable
{
    use HasMedias, HasPosition, HasFactory, HasRelated;
    protected $fillable = [
        'published',
        'title',
        'link',
        'button_text',
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
        'nav_reference',
        'position',
    ];
    public $mediasParams = [
        'reference_image' => [
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
