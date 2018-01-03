@extends('base')

@section('head')
    <style>
        h2 {
            font-size: 20px;
        }
        #block {
            height: 30px;
        }
        #explanation {
            margin: 30px 10px 10px 10px;
            padding: 10px;
            border: solid;
        }
        .title {
            font-weight: 900;
        }
        #next {
            font-size: 25px;
        }
    </style>
@endsection

@section('body')
    <div id="block"></div>
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="tlt">
                こんにちは、社会情報学研究室のブライソンです。今日は実験に参加してくれてどうもありがとう！
            </h2>
            <h2 class="tlt2">
                これから３つのこと（オプションでもう一つも可）をしてもらいます。想定している総時間は10分です。
            </h2>
        </div>
        <div id="explanation" class="row">
            <div class="col-12">
                <h2 class="title">
                    1. 被験者情報の登録
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    お名前と学籍番号を入力してもらいます。実験にとって大切なのはもちろんのこと、4.のためにも重要なのでよろしくお願いします。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    2. 実験
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実際に実験を行ってもらいます。何をするかは後ほど教えます。途中でやめられるとデータが不完全になったりしてしまうので、始めたらなるべく最後まで一気に終わらせてください。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    3. アンケート
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実験時に同時に逐次かんたんなアンケートを行います。実験とアンケートを5セット行ったら、実験は終了です。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    4. 図書カード500円分をもらう（オプション）
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実験が完了しますと、受け取り場所を告知しますので好きな時に受け取りに来てください。
                </h2>
            </div>
        </div>
    </div>

    <div id="next" class="container-fluid text-right">
        <a href="{{ action('ExperimentController@getRegister') }}" style="margin-right: 10px;">被験者情報登録に進む</a>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection