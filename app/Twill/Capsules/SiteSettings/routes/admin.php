<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'more'], function () {
  Route::module('siteSettings');
  Route::get('/GlobalSettings', 'SiteSettingController@landing')->name('more.siteSettings.landing');
});
