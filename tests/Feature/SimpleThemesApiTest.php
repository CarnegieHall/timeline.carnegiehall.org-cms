<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleThemesApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/themes');
    $response->assertStatus(200);
  }
}
