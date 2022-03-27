<?php

namespace Tests\Feature;

use App\Models\NotablePerformer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleNotablePerformerApiTest extends TestCase
{
  public function testApi()
  {
    $entry = NotablePerformer::published()->first();
    $response = $this->get('/api/notable-performers/' . $entry->id);
    $response->assertStatus(200);
  }
}
