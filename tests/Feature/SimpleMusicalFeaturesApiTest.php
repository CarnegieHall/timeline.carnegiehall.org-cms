<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleMusicalFeaturesApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/musical-features');
    $response->assertStatus(200);
  }
}
