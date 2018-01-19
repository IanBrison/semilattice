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
            margin-top: 15px;
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
                <div class="col-12 no-padding-col-12 small-question">
                    (1) 問Aと問Bには違いがありました。違いには気づきましたか。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question1" value="5"> はっきりと違いを認識していた
                    </div>
                    <div>
                        <input type="radio" name="question1" value="4"> 違いがあると感じていた
                    </div>
                    <div>
                        <input type="radio" name="question1" value="3"> 言われてみれば違った
                    </div>
                    <div>
                        <input type="radio" name="question1" value="2"> 言われても少し違和感を感じたくらい
                    </div>
                    <div>
                        <input type="radio" name="question1" value="1"> 全く気づかなかった
                    </div>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (2) その違いはどのくらいあると感じましたか。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question2" value="5"> かなりの違いがあった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="4"> それなりに違いが出ていた
                    </div>
                    <div>
                        <input type="radio" name="question2" value="3"> 少し違いが見受けられた
                    </div>
                    <div>
                        <input type="radio" name="question2" value="2"> ほとんど違いはなかった
                    </div>
                    <div>
                        <input type="radio" name="question2" value="1"> 全く違いが感じられなかった
                    </div>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (3) AとBではなにが違うと思いますか。複数の回答があっても構いません。
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question3"></textarea>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (4) AとBで料理がより探しやすかったのはどちらですか。また、もし理由があればお答えください。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question4" value="5"> Aの方がかなり探しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question4" value="4"> Aの方が少し探しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question4" value="3"> どちらも同じだった
                    </div>
                    <div>
                        <input type="radio" name="question4" value="2"> Bの方が少し探しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question4" value="1"> Bの方がかなり探しやすかった
                    </div>
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question4text"></textarea>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (5) AとBでより操作がしやすかったのはどちらですか。また、もし理由があればお答えください。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question5" value="5"> Aの方がかなり操作しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question5" value="4"> Aの方が少し操作しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question5" value="3"> どちらも同じだった
                    </div>
                    <div>
                        <input type="radio" name="question5" value="2"> Bの方が少し操作しやすかった
                    </div>
                    <div>
                        <input type="radio" name="question5" value="1"> Bの方がかなり操作しやすかった
                    </div>
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question5text"></textarea>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (6) AとBで使っていてより疲れやすかったのはどちらですか。また、もし理由があればお答えください。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question6" value="5"> Aの方がかなり疲れやすかった
                    </div>
                    <div>
                        <input type="radio" name="question6" value="4"> Aの方が少し疲れやすかった
                    </div>
                    <div>
                        <input type="radio" name="question6" value="3"> どちらも同じだった
                    </div>
                    <div>
                        <input type="radio" name="question6" value="2"> Bの方が少し疲れやすかった
                    </div>
                    <div>
                        <input type="radio" name="question6" value="1"> Bの方がかなり疲れやすかった
                    </div>
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question6text"></textarea>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (7) AとBでより効率がよかったと感じたのはどちらですか。また、もし理由があればお答えください。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question7" value="5"> Aの方がかなり効率よく探せた
                    </div>
                    <div>
                        <input type="radio" name="question7" value="4"> Aの方が少し効率よく探せた
                    </div>
                    <div>
                        <input type="radio" name="question7" value="3"> どちらも同じだった
                    </div>
                    <div>
                        <input type="radio" name="question7" value="2"> Bの方が少し効率よく探せた
                    </div>
                    <div>
                        <input type="radio" name="question7" value="1"> Bの方がかなり効率よく探せた
                    </div>
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question7text"></textarea>
                </div>
                <div class="col-12 no-padding-col-12 small-question">
                    (8) 最後にシステムそのものの使いやすさを評価してください。
                    システムが原因で実験がやりづらいと感じた場合は使いづらかった、実験がとてもスムーズにできたと感じた場合は使いやすかったとお答えください。
                    また、システムに対して感じたことがあれば記述をお願いします。
                </div>
                <div class="col-12">
                    <div>
                        <input type="radio" name="question8" value="5"> かなり使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question8" value="4"> 少し使いやすかった
                    </div>
                    <div>
                        <input type="radio" name="question8" value="3"> とくにどちらでもない
                    </div>
                    <div>
                        <input type="radio" name="question8" value="2"> 少し使いづらかった
                    </div>
                    <div>
                        <input type="radio" name="question8" value="1"> かなり使いづらかった
                    </div>
                </div>
                <div class="col-12">
                    <textarea style="width: 100%;" placeholder="なければ空欄でも大丈夫です" name="question8text"></textarea>
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
