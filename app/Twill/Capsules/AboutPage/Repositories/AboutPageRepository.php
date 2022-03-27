<?php

namespace App\Twill\Capsules\AboutPage\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use App\Twill\Capsules\AboutPage\Models\AboutPage;

class AboutPageRepository extends ModuleRepository
{
  use HandleBlocks, HandleMedias;

  public function __construct(AboutPage $model)
  {
    $this->model = $model;
  }

  public function getAboutPage()
  {
    if (filled($entry = $this->theOnlyOne())) {
      return $entry;
    }

    return $this->generate();
  }

  private function theOnlyOne()
  {
    return $this->model
      ->newQuery()
      ->withoutGlobalScope(MustBePublished::class)
      ->orderBy('id')
      ->take(1)
      ->get()
      ->first();
  }

  private function generate()
  {
    return app(AboutPageRepository::class)->create([
      'title' => "About Page",
      'published' => true,
    ]);
  }
}
