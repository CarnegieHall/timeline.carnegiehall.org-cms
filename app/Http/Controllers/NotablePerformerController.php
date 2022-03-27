<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotablePerformerResource;
use App\Models\NotablePerformer;
use Illuminate\Support\Facades\Cache;

class NotablePerformerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = NotablePerformer::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('notable_performer_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('notable_performer_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('notable_performer_index_timestamp');
          Cache::forget('notable_performer_index');
          Cache::put('notable_performer_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('notable_performer_index', $cacheTTL, function () {
      $data = NotablePerformer::published()->get();

      return response()->json(NotablePerformerResource::collection($data));
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
    return Cache::remember('notable_performer_' . $id, config('cache.expiration'), function () use ($id) {
      $data = NotablePerformer::where('id', $id)
        ->published()
        ->firstOrFail();

      return response()->json(new NotablePerformerResource($data));
    });
  }
}
