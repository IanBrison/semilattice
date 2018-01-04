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
        #explanation {
            margin: 10px 0px 10px 0px;
            padding: 10px;
            border: solid;
        }
        .title {
            font-weight: 900;
        }
        #next {
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>実験内容と注意点</h2>
        <div id="explanation" class="row">
            <div class="col-12">
                <h3 class="title">
                    実験内容
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    実験は料理探しです。
                </h4>
            </div>
        </div>
        <div id="explanation" class="row">
            <div class="col-12">
                <h3 class="title">
                    注意事項
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    1. 絶対戻らないでください。押し間違えをしてもそのままでいいです。<br>
                    2. できればそのまま最後までやってください。
                </h4>
            </div>
        </div>
        <div id="next" class="text-right">
            <a href="{{ action('ExperimentController@getExperiment', ['1', '1']) }}">実験スタート</a>
        </div>
    </div>
@endsection