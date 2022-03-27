<?php

namespace App\Http\Controllers;

use App\Twill\Capsules\SiteSettings\Models\SiteSetting;
use App\Twill\Capsules\SiteSettings\Http\Resources\SiteSettingResource;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = SiteSetting::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('site-settings_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('site-settings_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('site-settings_timestamp');
          Cache::forget('site-settings');
          Cache::put('site-settings_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('site-settings', $cacheTTL, function () {
      $data = SiteSetting::published()
        ->firstOrFail();

      return response()->json(new SiteSettingResource($data));
    });
  }
}
