<?php

namespace App\Http\Resources;

use App\Models\LinkedContent;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkedContentResource extends JsonResource
{
	function __construct(LinkedContent $model)
	{
		parent::__construct($model);
	}

	public function toArray($request)
	{
		$relatedContent = null;
		if ($this->related_content_id) {
			$relatedContent = $this->related_content_type::find($this->related_content_id);
		}


		return [
			'id' => $this->id,
			"position" => $this->position,
			"image" => $this->imageAsArray('reference_image'),
			"link" => $this->link,
			"button_text" => $this->button_text,
			$this->mergeWhen($relatedContent !== null, [
				'page' => $relatedContent ? [
					'id' => $relatedContent->id,
					'slug' => $relatedContent->slug,
					'type' => $this->related_content_type,
				] : []
			]),
		];
	}
}
