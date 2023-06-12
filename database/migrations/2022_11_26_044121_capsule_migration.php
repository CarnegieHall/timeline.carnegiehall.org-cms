<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  private $models = [
    ['App\Twill\Capsules\GlobalFooters\Models\GlobalFooter', 'App\Models\GlobalFooter'],
  ];

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    foreach ($this->models as $model) {
      echo $model[0] . ' to ' . $model[1];
      DB::table('blocks')
        ->where('blockable_type', $model[0])
        ->update(['blockable_type' => $model[1]]);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    foreach ($this->models as $model) {
      DB::table('blocks')
        ->where('blockable_type', "App\Twill\Capsules\{$model[0]}\Models\{$model[1]}")
        ->update(['blockable_type' => "App\Models\{$model[1]}"]);
    }
  }
};
