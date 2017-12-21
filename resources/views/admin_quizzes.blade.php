@extends('base')

@section('body')
    <div class="container">
        <h2>クイズ一覧</h2>
        <div class="row">
            @foreach($quizzes as $index => $quiz)
                <div class="col-4 row">
                    <h4 class="col-12">
                        問{{ $index + 1 }}
                    </h4>
                    <div class="col-4">
                        ターゲット
                    </div>
                    <div class="col-8">
                        {{ $quiz->content_id }}: {{ $quiz->content->name }}
                    </div>
                    <div class="col-4">
                        タイプ
                    </div>
                    <div class="col-8">
                        {{ $quiz->types->pluck('type_num')->implode(', ') }}
                    </div>
                    <form method="POST" class="col-12 row" action="{{ action('AdminController@postDeleteQuiz') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <div class="offset-8 col-4">
                            <button type="submit" class="btn btn-danger">削除</button>
                        </div>
                    </form>
                </div>
            @endforeach
            <div class="col-4">
                <h4>新しいクイズ</h4>
                <form method="POST" action="{{ action('AdminController@postCreateQuiz') }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-4">コンテンツID</label>
                        <input class="col-8" type="number" name="content_id">
                    </div>
                    <div class="form-group row">
                        <label class="col-4">タイプ</label>
                        <div class="col-8">
                        @foreach(\App\Type::all() as $type)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type->id }}">{{ $type->type_num }}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-8 col-4">
                            <button type="submit" class="btn btn-primary">作成</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection