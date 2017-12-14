@extends('base')

@section('head')
    <style>
        h2 {
            margin: 10px;
        }
        a {
            margin-top: 5px;
        }
        #look_for {
            margin-bottom: 15px;
        }
        #give_up {
            color: red;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <h2>探してほしいコンテンツ</h2>
            <div class="col-12" id="look_for">
                {{ $target_content->name }}<img src="{{ $quiz[1] }}" height="30px" width="30px">
            </div>
            <div class="col-8">
                <h2>選べるカテゴリ</h2>
                @foreach ($category->childs as $child)
                    <a class="btn btn-success" href="{{ action('ExperimentController@getExperiment', [$quiz_num, $child->id]) }}">{{ $child->name }}</a>
                @endforeach
            </div>
            <div class="col-4">
                <h2>コンテンツ</h2>
                <ul>
                    <li><a id="give_up" href="{{ action('ExperimentController@getResult', [$quiz_num, 0]) }}">見つからないので次に行く</a></li>
                    @foreach ($category->contents as $content)
                        <li><a href="{{ action('ExperimentController@getResult', [$quiz_num, $content->id]) }}">{{ $content->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection