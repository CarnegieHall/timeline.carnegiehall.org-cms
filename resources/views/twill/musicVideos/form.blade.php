@php
    $artworkImageSrcUrl = isset($item->apple_music_artwork->url) ? str_replace('{w}', '600', str_replace('{h}', '600', $item->apple_music_artwork->url)) : null;
@endphp

@extends('twill::layouts.form')

@section('contentFields')
@formField('input', [
    'name' => 'apple_music_video_id',
    'label' => 'Apple Music Video ID',
    'maxlength' => 30,
    'required' => false
])
@stop

@section('sideFieldsets')
@formFieldset(['id' => 'apple-music-search', 'title' => 'Search on Apple Music', 'open' => true])
<br />
<div id="apple-music-search-widget"></div>
@endformFieldset

@if ($item->apple_music_video_payload)
    @formFieldset(['id' => 'stored-apple-music-video', 'title' => 'Apple Music Video Details', 'open' => true])
    <div class="payload-data-items">
        <img src="{{ $artworkImageSrcUrl }}" width="100%" />
        <p><b>Artist: </b>{{ $item->apple_music_video_artist_name }}</p>
        <p><b>Album: </b>{{ $item->apple_music_video_album_name }}</p>
        <p><b>Song: </b>{{ $item->apple_music_video_name }}</p>
        <p><b>Release date: </b>{{ $item->apple_music_video_release_date }}</p>
        <p><b>Preview video URL: </b><a href="{{ $item->apple_music_preview_video_url }}"
                title="Open preview video in new tab" target='_blank'>Link</a></p>
    </div>
    @endformFieldset

    @formFieldset(['id' => 'apple-music-video', 'title' => 'Apple Music Video Data', 'open' => false])
    <textarea class="payload-display" name='apple_music_video_payload_as_string'
        readonly>{{ $item->apple_music_video_payload_as_string }}</textarea>
    <p class="updated-at">Updated at: {{ $item->apple_music_video_data_updated_at }}
    </p>
    @endformFieldset
@endif

@include('twill/_includes/api-link', ['name' => 'music-videos', 'entity' => $item->id])
@endsection

@push('extra_js_head')
    <script>
        // Set the developer token before Twill's Vue app mounts.
        window.apple_music_developer_token = '{{ config('apple-music.developer_token') }}';
    </script>
@endpush

@push('extra_js')
    <script>
        // Inject the video finder widget mount point after the input field
        var element = document.createElement('div');
        element.id = 'video-finder-widget';
        var fieldElement = document.getElementsByName('apple_music_video_id')[0]?.parentNode;
        if (fieldElement) fieldElement.parentNode.insertBefore(element, fieldElement.nextSibling);
    </script>
    @vite('resources/assets/js/app.jsx')
@endpush

<style>
    .payload-display {
        margin: 20px 0;
        padding: 8px;
        font-size: 12px;
        color: #444;
        border-radius: 6px;
        border: 2px solid #ccc;
        width: 100%;
        height: 300px;
    }

    .updated-at {
        margin: 0 !important;
        font-size: 12px;
        color: #666;
    }

    .payload-data-items {
        padding-top: 20px;
    }

    .payload-data-items img {
        margin-bottom: 12px;
    }

    .payload-data-items p {
        font-size: 12px !important;
        color: #444 !important;
        margin-bottom: 6px;
    }
</style>