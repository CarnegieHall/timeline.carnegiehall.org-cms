<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'more'], function () {
  Route::module('authors');
  Route::module('instruments');
  Route::module('musicalFeatures');
  Route::module('songs');
  Route::module('stories');
  Route::module('themes');
});

Route::get('deploy', 'DeployController@deploy')->name('deploy');
Route::module('authors');
Route::module('genres');
Route::module('notablePerformers');
Route::module('songs');
Route::module('stories');
