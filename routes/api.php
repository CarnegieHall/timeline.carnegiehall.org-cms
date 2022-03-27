<?php

use Illuminate\Support\Facades\Route;

Route::get('footer', 'FooterController@index');
Route::get('about-page', 'AboutPageController@index');
Route::get('site-settings', 'SiteSettingController@index');

Route::apiResources([
  'authors' => AuthorController::class,
  'genres' => GenreController::class,
  'instruments' => InstrumentController::class,
  'musical-features' => MusicalFeatureController::class,
  'notable-performers' => NotablePerformerController::class,
  'songs' => SongController::class,
  'stories' => StoryController::class,
  'themes' => ThemeController::class,
  'timeline' => TimelineController::class
], ['only' => ['index', 'show']]);
