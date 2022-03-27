<?php

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;
use A17\Twill\Services\MediaLibrary\ImageService;
use Illuminate\Support\Facades\Blade;

class GenreResource extends JsonResource
{
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
      unset($block->editor_name);
      unset($block->blockable_id);
      unset($block->blockable_type);
      unset($block->child_key);
      unset($block->parent_id);
    }

    $media = $this->imageAsArray('hero_image');
    $media['caption'] = $this->hero_caption;
    $media['credit'] = $this->hero_credit;
    $media['credit_link'] = $this->hero_credit_link;

    return [
      'id' => $this->id,
      'name' => $this->name,
      'slug' => $this->slug,
      'authors' => AuthorResource::collection($this->authors),
      'hero_image' => $media,
      'year_start' => $this->year_start,
      'year_finish' => $this->year_finish,
      'tradition' => $this->tradition ? Genre::$TRADITIONS_ENUM[array_search($this->tradition, array_column(Genre::$TRADITIONS_ENUM, 'key'))] : null,
      'display_date' => $this->display_date,
      'default_song' => SongResource::make($this->song),
      'citation' => $this->citation,
      'content' => $blocks,
      'songs' => SongResource::collection($this->songs),
      'influenced' => InfluenceResource::collection($this->influences),
      'influenced_by' => InfluenceResource::collection($this->influenced),
      'cross_influenced' => InfluenceResource::collection($this->cross_influences),
      'cross_influenced_by' => InfluenceResource::collection($this->cross_influenced),
      'notable_performers' => NotablePerformerResource::collection($this->notable_performers),
      'instruments' => InstrumentResource::collection($this->instruments),
      'themes' => ThemeResource::collection($this->themes),
      'musical_features' => MusicalFeatureResource::collection($this->musical_features),
      'seo' => [
        'title' => $this->seo_title,
        'description' => $this->seo_description,
        'image' => $this->image('seo_image')
      ]
    ];
  }
}
