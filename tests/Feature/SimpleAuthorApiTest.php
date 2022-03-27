<?php

namespace Tests\Feature;

use App\Models\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleAuthorApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Author::published()->first();
    $response = $this->get('/api/authors/' . $entry->id);
    $response->assertStatus(200);
  }
}
