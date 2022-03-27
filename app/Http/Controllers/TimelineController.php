<?php

namespace App\Http\Controllers;

use App\Http\Resources\TimelineResourceCollection;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;

class TimelineController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = Genre::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('timeline_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('timeline_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('timeline_index_timestamp');
          Cache::forget('timeline_index');
          Cache::put('timeline_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('timeline_index', $cacheTTL, function () {
      $data = Genre::published()
        ->orderBy('name', 'ASC')
        ->get();

      return response()->json((new TimelineResourceCollection($data)));
    });
  }
}
