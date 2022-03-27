<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
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
      'title' => $this->title,
      'artist' => NotablePerformerResource::make($this->notable_performer),
      'apple_music_song_id' => $this->apple_music_song_id,
      'song_file' => $this->apple_music_song_id ? $this->apple_music_preview_url : $this->file('song'),
      'video_file' => $this->file('video'),
      'created_at' => $this->created_at
    ];
  }
}
