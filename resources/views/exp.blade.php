@extends('base')

@section('body')
    @foreach ($category->childs as $child)
        <a href="{{ action('ExperimentController@getCategory', [$child->id]) }}">{{ $child->name }}</a>
    @endforeach
    <ul>
        @foreach ($category->contents as $content)
            <li>{{ $content->name }}</li>
        @endforeach
    </ul>
@endsection