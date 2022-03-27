<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleGenresApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/genres');
    $response->assertStatus(200);
  }
}
