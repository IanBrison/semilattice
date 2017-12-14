@extends('base')

@section('body')
    <div class="container">
        <p>実験手順を説明します</p>
        <a href="{{ action('ExperimentController@getExperiment', ['1', '1']) }}">スタート</a>
    </div>
@endsection