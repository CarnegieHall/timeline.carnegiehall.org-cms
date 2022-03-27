<?php

namespace App\Twill\Capsules\AboutPage\Http\Resources;

use A17\Twill\Services\MediaLibrary\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutPageResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $blocks = $this->blocks()->whereNull('parent_id')->with(['children.files'])->get();

    foreach ($blocks as $block) {
      if (isset($block->medias)) {
        foreach ($block->medias as $media) {
          $block->media_full_url = ImageService::getRawUrl($media->uuid);

          unset($media->id);
          unset($media->created_at);
          unset($media->updated_at);
          unset($media->deleted_at);
          unset($media->uuid);
          unset($media->filename);
          unset($media->identifier);
          unset($media->pivot->mediable_id);
          unset($media->pivot->mediable_type);
          unset($media->pivot->media_id);
          unset($media->pivot->role);
          unset($media->pivot->metadatas);
          unset($media->pivot->created_at);
          unset($media->pivot->updated_at);
        }
      }

      unset($block->id);
      unset($block->blockable_id);
      unset($block->blockable_type);
      unset($block->child_key);
      unset($block->parent_id);
    }

    return [
      'content' => $blocks,
    ];
  }
}
