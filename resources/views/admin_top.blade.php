@extends('base')

@section('body')
    <p>hello admin</p>
    <a href="{{ action('AdminController@getCategories') }}">カテゴリ可視化</a>
@endsection