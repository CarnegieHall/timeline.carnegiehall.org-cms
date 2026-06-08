<?php

namespace App\Providers;

use App\Http\Resources\SongResource;
use App\Models\MusicVideo;
use App\Models\Song;
use App\Observers\MusicVideoObserver;
use App\Observers\SongObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(): void
  {
    Blade::directive('audio', function ($expression) {
      return "<?php echo \App\Providers\AppServiceProvider::audioDirectiveOutput($expression); ?>";
    });

    Song::observe(SongObserver::class);
    MusicVideo::observe(MusicVideoObserver::class);
  }

  public static function audioDirectiveOutput(mixed $id): string
  {
    if (!$id) return '';
    $song = Song::find((int) $id);
    if (!$song) return '';
    $resource = htmlentities(
      SongResource::make($song)->toJson(),
      ENT_QUOTES,
      'UTF-8'
    );
    return '" data-song-json="' . $resource;
  }
}
