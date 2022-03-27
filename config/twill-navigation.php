<?php

return [
  'stories' => [
    'title' => 'Stories',
    'module' => true
  ],
  'genres' => [
    'title' => 'Genres',
    'module' => true
  ],
  'notablePerformers' => [
    'title' => 'Performers',
    'module' => true
  ],
  'songs' => [
    'title' => 'Songs',
    'module' => true
  ],
  'more' => [
    'title' => 'More',
    'route' => 'admin.more.authors.index',
    'primary_navigation' => [
      'authors' => [
        'title' => 'Authors',
        'create' => false,
        'module' => true
      ],
      'themes' => [
        'title' => 'Themes',
        'module' => true
      ],
      'instruments' => [
        'title' => 'Instruments',
        'module' => true
      ],
      'musicalFeatures' => [
        'title' => 'Musical Features',
        'module' => true
      ],
      'aboutPage' => [
        'title' => 'About Page',
        'route' => 'landing',
        'module' => true
      ],
      'globalFooters' => [
        'title' => 'Global Footer',
        'route' => 'landing',
        'module' => true
      ],
      'siteSettings' => [
        'title' => 'Site Settings',
        'route' => 'landing',
        'module' => true
      ],
    ]
  ],
  'deploy' => [
    'title' => 'Trigger Deploy',
    'route' => 'admin.deploy'
  ],
];
