@extends('base')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = window.Laravel || {};
        window.Laravel.csrfToken = "{{csrf_token()}}";
    </script>
    <style>
        img {
            max-width: 40%;
        }
        .quiz-div {
            border: solid;
            margin: 10px;
            padding: 10px;
        }
        h2 a {
            font-size: 15px;
        }
    </style>
@endsection

@section('body')
    <div id="app" class="container">
        <h2>クイズ一覧 <a href="{{ action('AdminController@getIndex') }}">adminトップへ戻る</a></h2>
        <div class="row">
            <div class="col-8 row" style="height: 100%;">
            @foreach($quiz_sets as $index => $quiz_set)
                <div class="col-12 row quiz-div">
                    <div class="col-12">
                        <form method="POST" action="{{ action('AdminController@postDeleteQuizSet') }}">
                            {{ csrf_field() }}
                        <h4>
                            問{{ $index + 1 }}
                            <input type="hidden" name="quiz_id" value="{{ $quiz_set->id }}">
                            <button type="submit" class="btn btn-danger">削除</button>
                        </h4>
                        </form>
                    </div>
                    <div class="col-2">
                        詳細a
                    </div>
                    <div class="col-10">
                        {{ $quiz_set->a->description }}
                    </div>
                    <div class="col-2">
                        画像a
                    </div>
                    <div class="col-10 text-center">
                        <img src="{{ $quiz_set->a->img_url }}">
                    </div>
                    <div class="col-2">
                        詳細b
                    </div>
                    <div class="col-10">
                        {{ $quiz_set->b->description }}
                    </div>
                    <div class="col-2">
                        画像b
                    </div>
                    <div class="col-10 text-center">
                        <img src="{{ $quiz_set->b->img_url }}">
                    </div>
                </div>
            @endforeach
            </div>
            <div class="col-4 row" style="height: 100%;">
                <div class="col-12">
                    <h4>新しいクイズ</h4>
                    <form method="POST" action="{{ action('AdminController@postCreateQuizSet') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-4">説明（a）</label>
                            <textarea class="col-8" name="description_a" required></textarea>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">画像（a）</label>
                            <input class="col-8" type="text" name="img_url_a">
                        </div>
                        <div class="form-group row">
                            <label class="col-4">説明（b）</label>
                            <textarea class="col-8" name="description_b" required></textarea>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">画像（b）</label>
                            <input class="col-8" type="text" name="img_url_b">
                        </div>
                        <div class="form-group row">
                            <div class="offset-8 col-4">
                                <button type="submit" class="btn btn-primary">作成</button>
                            </div>
                        </div>
                    </form>
                </div>
                <search-quizzes search_url="{{action('AdminController@getSearchQuizzes', ['keyword' => ''])}}"></search-quizzes>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/app.js"></script>
@endsection
