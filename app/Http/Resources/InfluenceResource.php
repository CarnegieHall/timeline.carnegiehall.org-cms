<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfluenceResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'year_start' => $this->year_start,
      'year_finish' => $this->year_finish,
      'tradition' => $this->tradition,
      'definition' => $this->definition,
      'display_date' => $this->display_date,
    ];
  }
}
