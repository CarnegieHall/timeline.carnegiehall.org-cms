<?php

namespace Tests\Feature;

use App\Models\Song;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleSongApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Song::published()->first();
    $response = $this->get('/api/songs/' . $entry->id);
    $response->assertStatus(200);
  }
}
