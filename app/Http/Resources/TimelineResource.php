<?php

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
  function __construct(Genre $model)
  {
    parent::__construct($model);
  }

  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'year_start' => $this->year_start,
      'year_finish' => $this->year_finish,
      'tradition' => $this->tradition ? Genre::$TRADITIONS_ENUM[array_search($this->tradition, array_column(Genre::$TRADITIONS_ENUM, 'key'))] : null,
      'display_date' => $this->display_date,
      'influenced' => InfluenceResource::collection($this->influences),
      'influenced_by' => InfluenceResource::collection($this->influenced),
      'cross_influenced' => InfluenceResource::collection($this->cross_influences),
      'cross_influenced_by' => InfluenceResource::collection($this->cross_influenced),
      // 'notable_performers' => NotablePerformerResource::collection($this->notable_performers),
      'instruments' => InstrumentResource::collection($this->instruments),
      'themes' => ThemeResource::collection($this->themes),
      'musical_features' => MusicalFeatureResource::collection($this->musical_features),
    ];
  }
}
