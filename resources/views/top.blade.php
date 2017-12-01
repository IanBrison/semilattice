@extends('base')

@section('body')
    <div class="container">
        <p>実験のためのトップページです</p>
        <a href="{{ action('ExperimentController@getStart') }}">実験開始</a>
    </div>
@endsection