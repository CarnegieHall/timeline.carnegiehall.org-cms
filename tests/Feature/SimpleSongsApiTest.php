<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleSongsApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/songs');
    $response->assertStatus(200);
  }
}
