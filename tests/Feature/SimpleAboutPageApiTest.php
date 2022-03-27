<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleAboutPageApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/about-page');
    $response->assertStatus(200);
  }
}
