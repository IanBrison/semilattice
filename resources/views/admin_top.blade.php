@extends('base')

@section('body')
    <p>hello admin</p>
    <a href="{{ action('AdminController@getCategoryVue') }}">カテゴリ可視化</a>
@endsection