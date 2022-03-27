<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleAuthorsApiTest extends TestCase
{
  public function testApi()
  {
    $response = $this->get('/api/authors');
    $response->assertStatus(200);
  }
}
