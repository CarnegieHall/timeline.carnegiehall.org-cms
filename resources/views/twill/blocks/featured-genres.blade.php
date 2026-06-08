@twillBlockTitle('Featured Genres')
@twillBlockIcon('info')
@twillBlockGroup('home')


@formField('browser', [
    'name' => 'featured_genres',
    'label' => 'Featured Genres',
    'moduleName' => 'genres',
    'note' => 'expects an even number of genres, so please add in increments of 2',
    'max' => 20,
])
