<?php

namespace App\Http\Controllers;

use App\Twill\Capsules\GlobalFooters\Models\GlobalFooter;
use App\Twill\Capsules\GlobalFooters\Http\Resources\FooterResource;
use Illuminate\Support\Facades\Cache;

class FooterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = GlobalFooter::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('footer_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('footer_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('footer_timestamp');
          Cache::forget('footer');
          Cache::put('footer_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('footer', $cacheTTL, function () {
      $data = GlobalFooter::published()
        ->firstOrFail();

      return response()->json(new FooterResource($data));
    });
  }
}
