<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'more'], function () {
  Route::module('aboutPage');
  Route::get('/about', 'AboutPageController@landing')->name('more.aboutPage.landing');
});
