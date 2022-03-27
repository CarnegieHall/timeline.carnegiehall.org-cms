<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = Theme::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('theme_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('theme_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('theme_index_timestamp');
          Cache::forget('theme_index');
          Cache::put('theme_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('theme_index', $cacheTTL, function () {
      $data = Theme::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(ThemeResource::collection($data));
    });
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return Cache::remember('theme_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Theme::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new ThemeResource($data));
    });
  }
}
