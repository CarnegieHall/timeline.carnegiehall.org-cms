<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleSiteSettingsApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/site-settings');
    $response->assertStatus(200);
  }
}
