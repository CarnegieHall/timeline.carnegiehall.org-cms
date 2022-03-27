@extends('twill::layouts.form', [
'disableContentFieldset' => true,
'additionalFieldsets' => [
['fieldset' => 'site_config', 'label' => 'Settings'],
['fieldset' => 'default_seo', 'label' => 'Default SEO Meta'],
['fieldset' => 'default_song', 'label' => 'Default Song'],
['fieldset' => 'featured_stories', 'label' => 'Featured Stories'],
]
])

@section('fieldsets')
@formFieldset(['id' => 'site_config', 'title' => 'Settings'])
@formField('input', [
'label' => 'Site Name',
'name' => 'site_name',
'placeholder' => 'e.g. Timeline of African American Music',
'required' => true,
])

@formField('input', [
'label' => 'Stories Index Heading',
'name' => 'stories_index_heading',
'placeholder' => '',
'required' => true,
])

@formField('input', [
'label' => '404: Heading',
'name' => '404_heading',
'placeholder' => '',
'required' => true,
])

@formField('input', [
'label' => '404: CTA',
'name' => '404_cta_message',
'placeholder' => 'e.g. Continue Exploring Other Stories',
'required' => true,
])

@formField('input', [
'label' => '404: Relative Link',
'name' => '404_cta_relative_link',
'placeholder' => 'e.g. /stories',
'required' => true,
])
@endformFieldset

@formFieldset(['id' => 'default_song', 'title' => 'Default Song'])
@formField('browser', [
'name' => 'song',
'label' => 'Songs',
'moduleName' => 'songs'
])
@endformFieldset

@formFieldset(['id' => 'featured_stories', 'title' => 'Featured Stories'])
@formField('browser', [
'name' => 'featured_stories',
'label' => 'Stories',
'moduleName' => 'stories',
'max' => 5
])
@endformFieldset

@formFieldset(['id' => 'default_seo', 'title' => 'Default SEO Meta'])
@formField('input', [
'label' => 'Default Stories Meta Title',
'name' => 'seo_stories_title',
'required' => true,
])
@formField('input', [
'type' => 'textarea',
'label' => 'Default Stories Meta Description',
'name' => 'seo_stories_description',
'required' => true,
'rows' => '2'
])
@formField('input', [
'label' => 'Default Genres Meta Title',
'name' => 'seo_genres_title',
'required' => true,
])
@formField('input', [
'type' => 'textarea',
'label' => 'Default Genres Meta Description',
'name' => 'seo_genres_description',
'required' => true,
'rows' => '2'
])
@formField('input', [
'label' => 'Default Timeline Meta Title',
'name' => 'seo_timeline_title',
'required' => true,
])
@formField('input', [
'type' => 'textarea',
'label' => 'Default Timeline Meta Description',
'name' => 'seo_timeline_description',
'required' => true,
'rows' => '2'
])
@endformFieldset
@stop
