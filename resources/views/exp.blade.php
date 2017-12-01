@extends('base')

@section('body')
    <div class="container">
        <h2>選べるカテゴリ</h2>
        @foreach ($category->childs as $child)
            <a class="btn btn-success" href="{{ action('ExperimentController@getCategory', [$child->id]) }}">{{ $child->name }}</a>
        @endforeach
        <h2 style="margin-top: 40px;">コンテンツ</h2>
        <ul>
            @foreach ($category->contents as $content)
                <li>{{ $content->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection