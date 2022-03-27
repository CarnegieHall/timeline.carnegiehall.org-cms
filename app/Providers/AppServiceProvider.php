<?php

namespace App\Providers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Blade::directive('audio', function ($id) {
      if (!$id) return '';
      $song = Song::find((int) $id);
      if (!$song) return '';
      $resource = htmlentities((SongResource::make($song)->toJson()), ENT_QUOTES, 'UTF-8');
      return "\" data-song-json=\"$resource";
    });
  }
}
