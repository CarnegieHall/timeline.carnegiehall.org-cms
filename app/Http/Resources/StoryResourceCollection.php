<?php

namespace App\Http\Resources;

use A17\Twill\Repositories\SettingRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StoryResourceCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    if (get_class($this->resource) === 'Illuminate\Pagination\LengthAwarePaginator') {
      return [
        'count' => $this->count(),
        'total' => $this->total(),
        'prev'  => $this->previousPageUrl(),
        'next'  => $this->nextPageUrl(),
        'data' => $this->collection,
      ];
    }

    return [
      'data' => $this->collection,
    ];
  }
}
