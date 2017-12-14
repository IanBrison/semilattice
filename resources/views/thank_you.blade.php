@extends('base')

@section('body')
    <div class="container">
        <a href="{{ action('ExperimentController@getIndex') }}">はじめに戻る</a>
    </div>
@endsection