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
        <h2>イアンの実験</h2>
        <div>
            <h4>
                こんにちは、社会情報学研究室のブライソンです。今日は実験に参加してくれてどうもありがとう！
                これから３つのこと（オプションでもう一つも可）をしてもらいます。想定している総時間は10分です。
            </h4>
        </div>
        <div id="explanation" class="row">
            <div class="col-12">
                <h3 class="title">
                    1. 被験者情報の登録
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    お名前と学籍番号を入力してもらいます。実験にとって大切なのはもちろんのこと、4.のためにも重要なのでよろしくお願いします。
                </h4>
            </div>
            <div class="col-12">
                <h3 class="title">
                    2. 実験
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    実際に実験を行ってもらいます。何をするかは後ほど教えます。途中でやめられるとデータが不完全になったりしてしまうので、始めたら最後まで一気に終わらせてください。
                </h4>
            </div>
            <div class="col-12">
                <h3 class="title">
                    3. アンケート
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    実験後にかんたんなアンケートを行います。アンケートに回答したら、実験は終了です。
                </h4>
            </div>
            <div class="col-12">
                <h3 class="title">
                    4. 図書カード1000円分をもらう（オプション）
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    実験が完了しますと、受け取り場所を告知しますので好きな時に受け取りに来てください。
                </h4>
            </div>
        </div>

        <div id="next" class="text-right">
            <a href="{{ action('ExperimentController@getRegister') }}">被験者情報登録に進む</a>
        </div>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection