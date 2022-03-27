<?php

namespace App\Http\Resources;

use A17\Twill\Services\MediaLibrary\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;

class StoryResource extends JsonResource
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
      if ($block->type == 'text') {
        if (isset($block->content['text'])) {
          $content = $block->content;
          $content['text'] = Blade::compileString($block->content['text']);
          $block->content = $content;
        }
      }

      foreach ($block->children as $child) {
        if (isset($child->medias)) {
          foreach ($child->medias as $media) {
            $child->media_full_url = ImageService::getRawUrl($media->uuid);

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

        unset($child->id);
        unset($child->editor_name);
        unset($child->blockable_id);
        unset($child->blockable_type);
        unset($child->position);
        unset($child->child_key);
        unset($child->parent_id);
      }

      unset($block->id);
      unset($block->blockable_id);
      unset($block->blockable_type);
      unset($block->child_key);
      unset($block->parent_id);
    }

    return [
      'id' => $this->id,
      'title' => $this->title,
      'slug' => $this->slug,
      'position' => $this->position,
      'hero_image' => $this->imageAsArray('hero_image'),
      'hero_image_attribution' => $this->hero_image_attribution,
      'color' => $this->color,
      'authors' => AuthorResource::collection($this->authors),
      'year_start' => $this->year_start,
      'year_finish' => $this->year_finish,
      'default_song' => SongResource::make($this->song),
      'citation' => $this->citation,
      'content' => $blocks,
      'seo' => [
        'title' => $this->seo_title,
        'description' => $this->seo_description,
        'image' => $this->image('seo_image')
      ]
    ];
  }
}
