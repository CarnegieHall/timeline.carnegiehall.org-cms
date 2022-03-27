<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicalFeatureResource;
use App\Models\MusicalFeature;
use Illuminate\Support\Facades\Cache;

class MusicalFeatureController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = MusicalFeature::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('musical_feature_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('musical_feature_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('musical_feature_index_timestamp');
          Cache::forget('musical_feature_index');
          Cache::put('musical_feature_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('musical_feature_index', $cacheTTL, function () {
      $data = MusicalFeature::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(MusicalFeatureResource::collection($data));
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
    return Cache::remember('musical_feature_' . $id, config('cache.expiration'), function () use ($id) {
      $data = MusicalFeature::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new MusicalFeatureResource($data));
    });
  }
}
