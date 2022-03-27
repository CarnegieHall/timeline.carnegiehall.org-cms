<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Support\Facades\Cache;

class SongController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = Song::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('song_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('song_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('song_index_timestamp');
          Cache::forget('song_index');
          Cache::put('song_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('song_index', $cacheTTL, function () {
      $data = Song::with(['notable_performer'])->published()->get();

      return response()->json(SongResource::collection($data));
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
    return Cache::remember('song_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Song::with(['notable_performer'])
        ->published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new SongResource($data));
    });
  }
}
