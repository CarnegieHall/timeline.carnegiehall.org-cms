<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = Author::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('author_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('author_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('author_index_timestamp');
          Cache::forget('author_index');
          Cache::put('author_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('author_index', $cacheTTL, function () {
      $data = Author::published()->ordered()->get();
      return response()->json(AuthorResource::collection($data));
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
    return Cache::remember('author_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Author::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new AuthorResource($data));
    });
  }
}
