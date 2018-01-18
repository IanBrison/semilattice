@extends('base')

@section('head')
    <style>
        h2 {
            margin: 8px 8px 8px 0px;
        }
        h3 {
            font-size: 20px;
        }
        h4 {
            font-size: 15px;
        }
        .explanation {
            margin: 10px 0px 10px 0px;
        }
        .title {
            font-weight: 900;
        }
        #next {
            margin-bottom: 25px;
        }
        img {
            max-width: 60%;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>実験{{ $quiz_set_num }} - {{ $a_b }}</h2>
        <div class="explanation">
            <h4 class="detail">
                {{ $quiz->description }}
            </h4>
        </div>
        <div class="explanation text-center">
            <img src="{{ $quiz->img_url }}">
        </div>
        <div id="next" class="text-right">
            <a href="{{ action('ExperimentController@getExperiment', [$quiz_num, '1']) }}">探し始める</a>
        </div>
    </div>
@endsection
