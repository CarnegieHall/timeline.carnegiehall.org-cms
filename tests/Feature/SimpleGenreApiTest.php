<?php

namespace Tests\Feature;

use App\Models\Genre;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleGenreApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Genre::published()->first();
    $response = $this->get('/api/genres/' . $entry->id);
    $response->assertStatus(200);
  }
}
