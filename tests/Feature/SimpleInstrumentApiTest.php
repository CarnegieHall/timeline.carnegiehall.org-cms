<?php

namespace Tests\Feature;

use App\Models\Instrument;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleInstrumentApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Instrument::published()->first();
    $response = $this->get('/api/instruments/' . $entry->id);
    $response->assertStatus(200);
  }
}
