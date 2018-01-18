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
            margin: 8px 8px 8px 0px;
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
            margin-left: 40%;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>アンケート</h2>
        <div>
            <h4>
                こんにちは、社会情報学研究室のブライソンです。今日は実験に参加してくれてどうもありがとう！
                これから３つのこと（あと謝礼の受け取りも！）をしてもらいます。想定している総時間は20~40分です。
            </h4>
        </div>
        <form action="{{ action('ExperimentController@postRegister') }}" method="post">
            <div class="row" style="margin: 0px;">
                {{ csrf_field() }}
                <h5>実験として</h5>
                <div>
                    aのカテゴリは、カテゴリとして使いやすい・使いづらいと感じたり、構造がわかりやすい・わかりづらいと感じることはありましたか。
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        <label for="input_password" class="col-4 col-sm-2 control-label">学籍番号：</label>
                        <div class="col-8 col-sm-8">
                            <input type="text" class="form-control" name="uni_id" placeholder="例）1G140000" required/>
                            <small class="form-text text-muted">同志社大学の学生以外の方は自由に埋めてください</small>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        <div class="offset-6 col-6 offset-sm-7 col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">登録して進む</button>
                        </div>
                    </div>
                </div>
            </div>
            　
        </form>
    </div>
@endsection
