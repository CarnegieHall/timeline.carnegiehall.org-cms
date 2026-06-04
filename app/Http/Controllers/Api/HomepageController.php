<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomepageResource;
use App\Models\Homepage;
use Illuminate\Support\Facades\Cache;

class HomepageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{


		$cacheTTL = now()->addSeconds(60);

		return Cache::remember('homepage', $cacheTTL, function () {
			$data = Homepage::published()->firstOrFail()->get();
			return response()->json(HomepageResource::collection($data));
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

		return Cache::remember('homepage', config('cache.expiration'), function () {
			$data = Homepage::published()->firstOrFail();
			return response()->json(new HomepageResource($data));
		});
	}
}
