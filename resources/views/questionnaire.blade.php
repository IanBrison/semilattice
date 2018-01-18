@extends('base')

@section('head')
    <style>
        h2 {
            margin: 8px 8px 8px 0px;
        }
        h4 {
            font-size: 15px;
        }
        h5 {
            margin: 8px 0px 0px 0px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        label {
            text-align: right;
            padding: 7px;
        }
        .check-label {
            margin-bottom: 0px;
        }
        .radio-div {
        }
        .radio-input {
        }
        .no-padding-col-12 {
            padding-left: 0px;
            padding-right: 0px;
        }
        .big-question {
            margin-bottom: 10px;
        }
        .small-question {
            margin-top: 5px;
        }
        .no-margin-row {
            margin: 0px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>アンケート</h2>
        <div>
            <h4>
                お疲れ様でした。以上で実験は終了です。最後にアンケートをお願いします。アンケートは主観評価に使われるものなので、思ったままの考えを記してください。
            </h4>
        </div>
        <form action="{{ action('ExperimentController@postQuestionnaire') }}" method="post">
            <div class="row no-margin-row">
                {{ csrf_field() }}
                <h5>「実験」</h5>
                <div class="col-12 no-padding-col-12 big-question">
                    実験中、a問とb問ではカテゴリが少し違うことに気が付いたかもしれません。それをふまえたうえでお答えください。
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (1) aのカテゴリは、カテゴリとして特別使いやすい・使いづらいと感じることはありましたか。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question1" value="5"> とても使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question1" value="4"> 少し使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question1" value="3" checked> とくになにも感じなかった
                    </div>
                    <div>
                        <input type="radio" name="question1" value="2"> 少し使いづらかった
                    </div>
                    <div>
                        <input type="radio" name="question1" value="1"> とても使いづらかった
                    </div>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (2) bのカテゴリは、カテゴリとして特別使いやすい・使いづらいと感じることはありましたか。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question2" value="5"> とても使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="4"> 少し使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="3" checked> とくになにも感じなかった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="2"> 少し使いづらかった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="1"> とても使いづらかった
                    </div>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (3) カテゴリについて思ったことがあればお願いします。
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" name="question3"></textarea>
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        <div class="offset-6 col-6 offset-sm-9 col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">回答完了</button>
                        </div>
                    </div>
                </div>
            </div>
            　
        </form>
    </div>
@endsection
