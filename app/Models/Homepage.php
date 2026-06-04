<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;


class Homepage extends Model
{
    use HasBlocks, HasMedias, HasFiles, HasRevisions, HasFactory;

    protected $fillable = [
        'published',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];
    public function hero_content()
    {
        return $this->hasMany(HeroFeaturedContent::class)->orderBy('position');
    }
    public $mediasParams = [
        'seo_image' => [
            'default' => [
                [
                    'name' => 'default'
                ]
            ]
        ]
    ];
}

