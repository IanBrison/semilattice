@extends('base')

@section('body')
    <p>実験のためのトップページです</p>
    <a href="{{ action('ExperimentController@getStart') }}">実験開始</a>
@endsection