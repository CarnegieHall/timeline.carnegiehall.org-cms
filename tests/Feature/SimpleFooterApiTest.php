<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleFooterApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/footer');
    $response->assertStatus(200);
  }
}
