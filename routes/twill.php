<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use A17\Twill\Facades\TwillRoutes; // Add this line

Route::group(['prefix' => 'more'], function () {
  TwillRoutes::module('authors');
  TwillRoutes::module('genres');
  TwillRoutes::module('instruments');
  TwillRoutes::module('menus');
  TwillRoutes::module('musicVideos');
  TwillRoutes::module('musicalFeatures');
  TwillRoutes::module('notablePerformers');
  TwillRoutes::module('pages');
  TwillRoutes::module('songs');
  TwillRoutes::module('stories');
  TwillRoutes::module('themes');

  TwillRoutes::module('globalFooters');
  Route::get('/globalFooter', 'GlobalFooterController@landing')->name('more.globalFooters.landing');

  TwillRoutes::module('siteSettings');
  Route::get('/GlobalSettings', 'SiteSettingController@landing')->name('more.siteSettings.landing');
});

TwillRoutes::module('authors');
TwillRoutes::module('genres');
TwillRoutes::module('instruments');
TwillRoutes::module('menus');
TwillRoutes::module('musicVideos');
TwillRoutes::module('musicalFeatures');
TwillRoutes::module('notablePerformers');
TwillRoutes::module('pages');
TwillRoutes::module('songs');
TwillRoutes::module('stories');
TwillRoutes::module('themes');

Route::get('deploy', 'DeployController@deploy')->name('deploy');

Route::name('appleMusicStatus')->get('/apple-music-status', 'AppleMusicStatusController@show');

Route::get('run-check-resource-urls', function () {
  Artisan::call('ch:check-resource-urls', []);
  session()->flash('status', 'Periodically reload this page to check for changes');
  return redirect()->route('twill.appleMusicStatus');
});

TwillRoutes::singleton('homepage');
TwillRoutes::module('heroFeaturedContents');

TwillRoutes::module('linkedContents');