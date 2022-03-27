<?php

namespace Tests\Feature;

use App\Models\Theme;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleThemeApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Theme::published()->first();
    $response = $this->get('/api/themes/' . $entry->id);
    $response->assertStatus(200);
  }
}
