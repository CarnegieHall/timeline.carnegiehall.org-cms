<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleNotablePerformersApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/notable-performers');
    $response->assertStatus(200);
  }
}
