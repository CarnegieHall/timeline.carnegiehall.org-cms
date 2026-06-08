<?php

namespace App\Http\Resources;

use App\Models\HeroFeaturedContent;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroFeaturedContentResource extends JsonResource
{
	function __construct(HeroFeaturedContent $model)
	{
		parent::__construct($model);
	}

	public function toArray($request)
	{
		$relatedContent = null;
		switch ($this->destination) {
			case 'page':
				$relatedContent = $this->related_page_type::find($this->related_page_id);
				break;
			case 'story':
				$relatedContent = $this->related_story_type::find($this->related_story_id);
				break;
			case 'notablePerformer':
				$relatedContent = $this->related_notablePerformer_type::find($this->related_notablePerformer_id);
				break;
			case 'genre':
				$relatedContent = $this->related_genre_type::find($this->related_genre_id);
				break;
			default:
				$relatedContent = null;
				break;
		}

		return [
			'id' => $this->id,
			"title" => $this->title,
			'subtitle' => $this->subtitle,
			'color' => $this->main_color,
			"position" => $this->position,
			"destination" => $this->destination,
			"image" => $this->imageAsArray('hero_image'),
			"external_link" => $this->external_link,
			$this->mergeWhen($relatedContent !== null, [
				'page' => $relatedContent ? [
					'id' => $relatedContent->id,
					'slug' => $relatedContent->slug,
					'type' => $this["related_" . $this->destination . "_type"],
				] : []
			]),
		];
	}
}
