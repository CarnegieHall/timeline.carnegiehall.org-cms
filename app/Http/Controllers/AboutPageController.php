<?php

namespace App\Http\Controllers;

use App\Twill\Capsules\AboutPage\Models\AboutPage;
use App\Twill\Capsules\AboutPage\Http\Resources\AboutPageResource;
use Illuminate\Support\Facades\Cache;

class AboutPageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = AboutPage::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('about-page_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('about-page_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('about-page_timestamp');
          Cache::forget('about-page');
          Cache::put('about-page_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('about-page', $cacheTTL, function () {
      $data = AboutPage::published()
        ->firstOrFail();

      return response()->json(new AboutPageResource($data));
    });
  }
}
