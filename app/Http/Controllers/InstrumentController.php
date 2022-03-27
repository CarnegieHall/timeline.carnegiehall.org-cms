<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstrumentResource;
use App\Models\Instrument;
use Illuminate\Support\Facades\Cache;

class InstrumentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addMinutes(4);

    if ($latestEntry = Instrument::latest()->first()) {
      // Check we have a cache already
      if (Cache::has('instrument_index_timestamp')) {
        // If the latest entry is newer than the cache, flush it.
        if (cache('instrument_index_timestamp') < $latestEntry->updated_at->timestamp) {
          Cache::forget('instrument_index_timestamp');
          Cache::forget('instrument_index');
          Cache::put('instrument_index_timestamp', $latestEntry->updated_at->timestamp);
          $cacheTTL = now()->addDays(180);
        }
      }
    }

    return Cache::remember('instrument_index', $cacheTTL, function () {
      $data = Instrument::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(InstrumentResource::collection($data));
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
    return Cache::remember('instrument_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Instrument::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new InstrumentResource($data));
    });
  }
}
