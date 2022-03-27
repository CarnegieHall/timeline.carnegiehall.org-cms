<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class DeployController extends Controller
{
  public function deploy()
  {
    $client = new Client();
    $client->post(config('deployment.webhook_url'));
    session()->flash('status', 'Deployment triggered');
    return redirect()->route('admin.dashboard');
  }
}
