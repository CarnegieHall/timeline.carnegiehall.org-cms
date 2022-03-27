<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'more'], function () {
  Route::module('globalFooters');
  Route::get('/globalFooter', 'GlobalFooterController@landing')->name('more.globalFooters.landing');
});
