<?php

return [
  'homepage' => [
    'title' => 'Homepage',
    'singleton' => true,
  ],
  'more' => [
    'title' => 'Manage Content',
    'route' => 'twill.more.stories.index',
    'primary_navigation' => [
      'pages' => [
        'title' => 'Pages',
        'module' => true,
      ],
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
      'musicVideos' => [
        'title' => 'Music Videos',
        'module' => true
      ],
      'authors' => [
        'title' => 'Authors',
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
      ]
    ]
  ],
  'menus' => [
    'title' => 'Menus',
    'module' => true
  ],
  'deploy' => [
    'title' => 'Build & Deploy',
    'route' => 'twill.deploy'
  ],
  'settings' => [
    'title' => 'CMS Settings',
    'route' => 'twill.settings',
    'params' => ['section' => 'vercel'],
    'primary_navigation' => [
      'vercel' => [
        'title' => 'Vercel',
        'route' => 'twill.settings',
        'params' => ['section' => 'vercel']
      ],
      'preview' => [
        'title' => 'Preview',
        'route' => 'twill.settings',
        'params' => ['section' => 'preview']
      ],
      'apple-music-notifier' => [
        'title' => 'Apple Music Notifier',
        'customTitle' => 'test',
        'route' => 'twill.settings',
        'params' => ['section' => 'apple-music-notifier']
      ],
    ]
  ],
  'appleMusicStatus' => [
    'title' => 'Apple Music Notifier',
    'route' => 'twill.appleMusicStatus',
  ],
];
