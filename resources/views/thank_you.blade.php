@extends('base')

@section('body')
    <div class="container">
        <h2>実験終了</h2>
        <a href="{{ action('ExperimentController@getIndex') }}">はじめに戻る</a>
    </div>
@endsection