<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleInstrumentsApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/instruments');
    $response->assertStatus(200);
  }
}
