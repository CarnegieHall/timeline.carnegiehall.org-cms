@extends('twill::layouts.form')

@section('contentFields')
    <br />
    <h1> Hero </h1>
    @formField('repeater', [
        'type' => 'hero-featured-content',
        'max' => 3,
    ])

    @formField('block_editor', [
        'blocks' => ['app-timelinefilter', 'title-module', 'featured-performers', 'featured-genres', 'index-module', 'playlist-module'],
    ])
@stop


@section('sideFieldsets')
    @include('twill/_includes/seo')
@endsection
