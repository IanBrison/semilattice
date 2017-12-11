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
            margin: 10px;
            padding: 10px;
            border: solid;
            display: none;
        }
        .title {
            font-weight: 900;
        }
    </style>
@endsection

@section('body')
    <div id="block"></div>
    <div class="container">
        <h2 class="tlt">
            こんにちは、社会情報学研究室のブライソンです。今日は実験に参加してくれてどうもありがとう！
        </h2>
        <h2 class="tlt2">
            これから３つのこと（オプションでもう一つも可能）をしてもらいます。想定している総時間は10分です。
        </h2>
        <div id="explanation" class="row">
            <div class="col-12">
                <h2 class="title">
                    ①被験者情報の登録
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    学年・性別・学部・お名前などを入力してもらいます。実験にとって大切なのはもちろんのこと、④のためにも重要なのでよろしくお願いします。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    ②実験
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実際に実験を行ってもらいます。何をするかは後ほど教えます。途中でやめられるとデータが不完全になったりしてしまうので、始めたらなるべく最後まで終わらせてください。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    ③アンケート
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実験時に同時に逐次かんたんなアンケートを行います。実験とアンケートを5セット行ったら、実験は終了です。
                </h2>
            </div>
            <div class="col-12">
                <h2 class="title">
                    ④図書カード500円分をもらう（オプション）
                </h2>
            </div>
            <div class="col-12">
                <h2 class="detail">
                    実験が終わりますと、受け取り場所を告知しますので好きな時に受け取りに来てください。
                </h2>
            </div>
        </div>
    </div>

    <div id="next" class="container text-right" style="display: none;">
        <a href="{{ action('ExperimentController@getStart') }}">被験者情報登録に進む</a>
    </div>
@endsection

@section('script')
    <script>
        $('.tlt').textillate({autoStart: true, in : {effect: 'fadeIn', sync: true, delayScale: 1.5}}).on('end.tlt', function() {
            $('.tlt2').textillate('start');
        });
        $('.tlt2').textillate({autoStart: false, in : {effect: 'fadeIn', sync: true, delayScale: 1.5}}).on('end.tlt', function() {
            $('.tlt3').textillate('start');
            $('#explanation').fadeIn(2000, function () {
                $('#next').fadeIn();
            });
        });
    </script>
@endsection