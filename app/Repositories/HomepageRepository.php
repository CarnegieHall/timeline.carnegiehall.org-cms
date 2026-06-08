<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Homepage;



class HomepageRepository extends ModuleRepository
{
    use HandleBlocks, HandleMedias, HandleFiles, HandleRevisions;

    public function __construct(Homepage $model)
    {
        $this->model = $model;
    }


    public function afterSave($object, $fields): void
    {
        $this->updateRepeater($object, $fields, 'hero_content', 'App\Repositories\HeroFeaturedContentRepository', 'hero-featured-content');
        parent::afterSave($object, $fields);
    }

    public function getFormFields($object): array
    {
        $fields = parent::getFormFields($object);
        $fields = $this->getFormFieldsForRepeater($object, $fields, 'hero_content', 'App\Repositories\HeroFeaturedContentRepository', 'hero-featured-content');
        return $fields;
    }
}
