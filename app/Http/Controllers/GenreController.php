<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenreResourceCollection;
use Illuminate\Support\Facades\Cache;

class GenreController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Genre::with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
      ->published()
      ->orderBy('name', 'ASC')
      ->paginate(10);

    return response()->json((new GenreResourceCollection($data)));
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data = Genre::with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
    ->published()
    ->get()
    ->where('slug', $id)
    ->first();

    return response()->json(new GenreResource($data));
  }
}
