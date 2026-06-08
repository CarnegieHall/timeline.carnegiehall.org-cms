<?php

namespace App\Http\Resources;
use A17\Twill\Services\MediaLibrary\ImageService;
use App\Models\Genre;
use App\Models\NotablePerformer;
use App\Models\Story;
use App\Models\Page;
use App\Models\Song;
use Illuminate\Http\Resources\Json\JsonResource;

class HomepageResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */

	function unsetBlockDefaults($block): void
	{
		unset($block->medias);
		if (count($block->children) == 0) {
			unset($block->children);
		}
		unset($block->files);
		unset($block->content);
		unset($block->block);
		unset($block->editor_name);
		unset($block->blockable_id);
		unset($block->blockable_type);
		unset($block->child_key);
		unset($block->parent_id);
	}

	function setRelatedContent($block): void
	{

		switch ($block->destination) {
			case "page":
				$relatedContentField = $block->content['browsers']['related_page'];
				$selectedContent = Page::find($relatedContentField);
				$block['related_content'] = PageResource::collection($selectedContent);
				break;
			case "pages":
				$relatedContentField = $block->content['browsers']['related_page'];
				$selectedContent = Page::find($relatedContentField);
				$block['related_content'] = PageResource::collection($selectedContent);
				break;
			case "story":
				$relatedContentField = $block->content['browsers']['related_story'];
				$selectedContent = Story::find($relatedContentField);
				$block['related_content'] = StoryResource::collection($selectedContent);
				break;
			case "stories":
				$relatedContentField = $block->content['browsers']['related_story'];
				$selectedContent = Story::find($relatedContentField);
				$block['related_content'] = StoryResource::collection($selectedContent);
				break;
			case "notablePerformer":
				$relatedContentField = $block->content['browsers']['related_notablePerformer'];
				$selectedContent = NotablePerformer::find($relatedContentField);
				$block['related_content'] = NotablePerformerResource::collection($selectedContent);
				break;
			case "notablePerformers":
				$relatedContentField = $block->content['browsers']['related_notablePerformers'];
				$selectedContent = NotablePerformer::find($relatedContentField);
				$block['related_content'] = NotablePerformerResource::collection($selectedContent);
				break;
			case "genres":
				$relatedContentField = $block->content['browsers']['related_genre'];
				$selectedContent = Genre::find($relatedContentField);
				$block['related_content'] = GenreResource::collection($selectedContent);
				break;
			case "genre":
				$relatedContentField = $block->content['browsers']['related_genre'];
				$selectedContent = Genre::find($relatedContentField);
				$block['related_content'] = GenreResource::collection($selectedContent);
				break;
			default:
				$block['related_content'] = null;
				break;
		}
	}
	public function toArray($request)
	{
		$relatedBrowsers = [
			'related_page',
			'related_story',
			'related_notablePerformer',
			'related_genre',
		];
		$blocks = [];
		$blocks = $this->blocks()->whereNull('parent_id')->with(['children.files'])->get();

		foreach ($blocks as $block) {

			if ($block->type == 'app-timelinefilter') {
				$block->title = $block->content['title'] ?? '';
				$block->description = $block->content['description'] ?? '';
				$block->demo_video = $block->files[0] ?? null;
				$this->setRelatedContent($block);
				$this->unsetBlockDefaults($block);
			}

			if ($block->type == "title-module") {
				$block->title = $block->content['heading'] ?? '';
				$block->description = $block->content['text'] ?? '';
				$block->destination = $block->content['destination'] ?? '';
				$block->button_text = $block->content['button_text'] ?? '';
				$block->external_link = $block->content['external_link'] ?? '';

				$this->setRelatedContent($block);
				$this->unsetBlockDefaults($block);

			}

			if ($block->type == "featured-performers") {
				$relatedContentField = $block->content['browsers']['featured_performers'];

				$selectedContent = NotablePerformer::find($relatedContentField);
				$thisPerformers = NotablePerformerResource::collection($selectedContent);

				$block['featured_performers'] = $thisPerformers;
				$this->unsetBlockDefaults($block);

			}
			if ($block->type == "featured-genres") {
				$relatedContentField = $block->content['browsers']['featured_genres'];
				$selectedContent = Genre::find($relatedContentField);
				$featured_genres = GenreResource::collection($selectedContent);
				$block['featured_genres'] = $featured_genres;
				$this->unsetBlockDefaults($block);
			}

			if ($block->type == "playlist-module") {
				$relatedContentField = $block->content['browsers']['featured_songs'];
				$selectedContent = Song::find($relatedContentField);
				$featured_genres = SongResource::collection($selectedContent);
				$block['featured_songs'] = $featured_genres;
				$this->unsetBlockDefaults($block);
			}
			if ($block->type == "index-module") {
				$block->heading = $block->content['heading'] ?? '';
				$block->link = $block->content['link'] ?? '';
				$block->button_text = $block->content['button_text'] ?? '';

				foreach ($block->children as $child) {
					$child->link = $child->content['external_link'] ?? '';
					$child->destination = $child->content['destination'] ?? '';
					$child->button_text = $child->content['button_text'] ?? '';
					$child->nav_reference = $child->content['nav_reference'] ?? '';
					$this->setRelatedContent($child);
					if (isset($child->medias)) {
						foreach ($child->medias as $media) {

							$child->reference_image = ImageService::getRawUrl($media->uuid);

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
					unset($child->editor_name);
					unset($child->blockable_id);
					unset($child->blockable_type);
					unset($child->files);
					unset($child->children);
					$this->unsetBlockDefaults($child);
				}

				$this->unsetBlockDefaults($block);
			}
		}


		return [
			'hero' => HeroFeaturedContentResource::collection($this->hero_content),
			'blocks' => $blocks,
		];
	}
}
