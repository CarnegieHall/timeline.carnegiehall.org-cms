@extends('twill::layouts.form')

@section('contentFields')
@formField('browser', [
'moduleName' => 'notablePerformers',
'name' => 'notable_performer',
'label' => 'Performer',
'max' => 1,
'required' => true
])

@formField('input', [
'name' => 'apple_music_song_id',
'label' => 'Apple Music Song ID',
'maxlength' => 30,
'required' => false
])

@formField('files', [
'name' => 'song',
'label' => 'Song file',
'note' => 'Add one file'
])

@formField('files', [
'name' => 'video',
'label' => 'Video file',
'note' => 'Add video file'
])
@stop

@push('extra_js')
<script>
    // Set the developer token to be used in the custom js file.
    window.apple_music_developer_token = '{{ config('apple-music.developer_token') }}';

    // Inject the widget
    var element = document.createElement('div');
    element.id = 'song-finder-widget';
    element.innerHTML = '<song-finder/>'; // add the vue component
    var fieldElement = document.getElementsByName('apple_music_song_id')[0].parentNode;
    if (fieldElement) fieldElement.parentNode.insertBefore(element, fieldElement.nextSibling);
</script>

{{-- For this project, no custom JS has been created. We're going to inject the global app js here for now. --}}
<script src="{{asset('js/app.js')}}"></script>
@endpush
