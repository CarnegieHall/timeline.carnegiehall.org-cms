<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Model;
use \Symfony\Component\HttpClient\CurlHttpClient;
use PouleR\AppleMusicAPI\APIClient;
use PouleR\AppleMusicAPI\AppleMusicAPI;
use Illuminate\Support\Facades\Log;

class Song extends Model
{
  use HasRelated, HasFiles;

  protected $fillable = [
    'published',
    'title',
    'mp4_sound',
    'mp4_video',
    'apple_music_song_id',
    'notable_performer_id'
  ];

  public $checkboxes = [
    'published'
  ];

  public $filesParams = ['song', 'video'];

  public function getArtistAttribute()
  {
    return optional($this->notable_performer)->name;
  }

  public function getAppleMusicPreviewUrlAttribute()
  {
    if ($this->apple_music_song_id) {
      try {
        return Cache::remember('apple_music_song_' . $this->apple_music_song_id, 60 * 30, function () {
          $curl = new CurlHttpClient(['max_duration' => 5]);
          $client = new APIClient($curl);
          $client->setDeveloperToken(config('apple-music.developer_token'));
          $api = new AppleMusicAPI($client);
          $result = $api->getCatalogSong('us', $this->apple_music_song_id);
          if ($result && $result->data[0]->attributes->previews[0]->url) {
            return $result->data[0]->attributes->previews[0]->url;
          }

          return null;
        });
      } catch (\Throwable $th) {
        report($th);
        Log::warning('Song failed to be fetched from Apple Music: ' . $this->apple_music_song_id);
        return false;
      }
    }
    return null;
  }

  public function genres()
  {
    return $this->belongsToMany(Genre::class);
  }

  public function notable_performer()
  {
    return $this->belongsTo(NotablePerformer::class);
  }
}
