<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Repositories\Behaviors\HandleBrowser;
use App\Models\NotablePerformer;
use App\Models\Song;
use App\Models\Genre;

class SongRepository extends ModuleRepository
{
  use HandleFiles;
  use HandleBrowser;

  public function __construct(Song $model)
  {
    $this->model = $model;
  }
  protected $relatedBrowsers = [
    'genre',
    'notable_performer'
  ];
  public function filter(\Illuminate\Database\Eloquent\Builder $query, array $scopes = []): \Illuminate\Database\Eloquent\Builder
  {
    if (isset($scopes['title'])) {
      $query->orWhere('title', 'like', "%{$scopes['title']}%");
      unset($scopes['title']);
    }

    if (isset($scopes['performer'])) {
      $query->orWhereHas('notable_performer', function ($query) use ($scopes) {
        $query->where('name', 'like', "%{$scopes['performer']}%");
      });
      unset($scopes['performer']);
    }

    return parent::filter($query, $scopes);
  }
  public function afterSave(\A17\Twill\Models\Contracts\TwillModelContract $object, array $fields): void
  {
    $this->updateBelongsTo($object, $fields, 'notable_performer', NotablePerformer::class);
    $this->updateBelongsTo($object, $fields, 'genre', Genre::class);
    parent::afterSave($object, $fields);
  }

  public function getFormFields(\A17\Twill\Models\Contracts\TwillModelContract $object): array
  {
    $fields = parent::getFormFields($object);
    $artist = $object->notable_performer;

    if ($artist) {
      $fields['browsers']['notable_performer'][] = [
        'id' => $artist->id,
        'name' => $artist->name,
        'edit' => moduleRoute('notable_performers', '', 'edit', $artist->id),
        'endpointType' => 'notable_performers'
      ];
    }


    return $fields;
  }
}
