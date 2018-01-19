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
        #caution {
            color: red;
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
                    実験は「料理探し」です。お題が10問出てくるので、カテゴリを駆使して料理を選んでください！
                    カテゴリの内容、レシピはともに「楽天レシピ」のデータを利用させてもらっております。以下のポイントに気をつけてください。<br><br>
                    1. 被験者の料理の腕前は関係ありません。選びたい料理を選んでください。<br>
                    2. ページを戻ることは全然構いません。むしろしてください。ただし一度回答した問題まで戻ることはしないでください。<br>
                    3. 料理の詳細が見れるわけではありません。写真やタイトルで判断して料理は選んでください。<br>
                    4. どうしても料理が見つからなかったり、選べなかった場合は料理欄上部の赤文字を押して次の問題に行って構いません。ですが、できれば時間をかけてでも回答してほしいです。
                </h4>
            </div>
        </div>
        <div id="explanation" class="row">
            <div class="col-12">
                <h3 id="caution" class="title">
                    厳守事項
                </h3>
            </div>
            <div class="col-12">
                <h4 class="detail">
                    ・絶対URLをいじったりしないでください。画面内のボタンとページを戻る動作以外で移動しないでください。<br>
                    ・一度始めたら途中でやめずそのまま最後までやってください。
                </h4>
            </div>
        </div>
        <div id="next" class="text-right">
            <a href="{{ action('ExperimentController@getQuiz', ['1']) }}">実験スタート</a>
        </div>
    </div>
@endsection
