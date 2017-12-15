@extends('base')

@section('head')
    <style>
        h2 {
            margin: 10px;
        }
        h3 {
            margin: 10px;
        }
        a {
            margin-top: 5px;
        }
        .pagination-button {
            margin-top: 0px;
        }
        #look_for {
            margin-bottom: 15px;
        }
        #give_up {
            color: red;
        }
        .hidden_button {
            visibility: hidden;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12" id="look_for">
                <h2>探してほしいコンテンツ</h2>
                {{ $target_content->name }}<img src="{{ $quiz[1] }}" height="30px" width="30px">
            </div>
            <div class="col-12">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="col-8">
                <h3>カテゴリ</h3>
                @foreach ($category->childs as $child)
                    <a class="btn btn-success" href="{{ action('ExperimentController@getExperiment', [$quiz_num, $child->id]) }}">{{ $child->name }}</a>
                @endforeach
            </div>
            <div class="col-4">
                <h3>コンテンツ</h3>
                @if ($contents->hasPages() )
                <div class="text-center">
                    @if ($contents->currentPage() > 1)
                        <a class="btn btn-info pagination-button" href="{{ $contents->previousPageUrl() }}">前へ</a>
                    @else
                        <a class="btn btn-info pagination-button hidden_button" href="{{ $contents->previousPageUrl() }}">前へ</a>
                    @endif
                    @if ($contents->hasMorePages())
                        <a class="btn btn-info pagination-button" href="{{ $contents->nextPageUrl() }}">次へ</a>
                    @else
                        <a class="btn btn-info pagination-button hidden_button" href="{{ $contents->nextPageUrl() }}">次へ</a>
                    @endif
                </div>
                @endif
                <ul>
                    <li><a id="give_up" href="{{ action('ExperimentController@getResult', [$quiz_num, 0]) }}">見つからないので次に行く</a></li>
                    @foreach ($contents as $content)
                        <li><a href="{{ action('ExperimentController@getResult', [$quiz_num, $content->id]) }}">{{ $content->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection