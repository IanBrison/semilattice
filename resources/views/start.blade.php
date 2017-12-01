@extends('base')

@section('body')
    <p>実験手順を説明します</p>
    <a href="{{ action('ExperimentController@getCategory', ['1']) }}">スタート</a>
@endsection