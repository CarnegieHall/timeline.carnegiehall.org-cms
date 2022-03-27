<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleStoriesApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/stories');
    $response->assertStatus(200);
  }
}
