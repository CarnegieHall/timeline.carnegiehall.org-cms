@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'name',
        'type' => 'text',
        'label' => 'Name',
        'maxlength' => 255,
        'required' => true
    ])

    @formField('medias', [
        'name' => 'image',
        'label' => 'Image',
        'required' => true
    ])

    @formField('input', [
        'name' => 'attribution',
        'type' => 'text',
        'label' => 'Attribution',
        'maxlength' => 255,
        'required' => false
    ])
@stop
