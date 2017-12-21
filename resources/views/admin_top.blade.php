@extends('base')

@section('body')
    <div class="container">
        <h2>イアンの管理画面</h2>
        <a href="{{ action('AdminController@getCategoryVue') }}" class="btn btn-info">カテゴリ表示</a>
        <a href="{{ action('AdminController@getSubjectResults') }}" class="btn btn-info">みんなの結果</a>
        <a href="{{ action('AdminController@getQuizzes') }}" class="btn btn-info">クイズ一覧</a>
    </div>
@endsection