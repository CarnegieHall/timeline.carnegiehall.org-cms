<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoryResource;
use App\Http\Resources\StoryResourceCollection;
use App\Models\Story;
use Illuminate\Support\Facades\Cache;

class StoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Story::published()->ordered()->paginate(10);
    return response()->json(new StoryResourceCollection($data));
  }

  /**
   * Display the specified resource.
   *
   * @param  integer $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data = Story::published()->get()->where('slug', $id)->first();
    return response()->json(new StoryResource($data));
  }
}
