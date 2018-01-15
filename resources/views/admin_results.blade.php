@extends('base')

@section('head')
    <style>
        .subject-div {
            border: thin solid;
            margin: 5px;
        }
        .subject-name {
            padding: 5px;
        }
        h3 {
            font-size: 20px;
        }
        .track_category_good {
            color: black;
            border-bottom: solid 1px green;
        }
        .track_category_bad {
            color: black;
            border-bottom: solid 1px red;
        }
        .track_content_good {
            color: green;
        }
        .track_content_bad {
            color: red;
        }
        h2 a {
            font-size: 15px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>みんなの結果 <a href="{{ action('AdminController@getIndex') }}">adminトップへ戻る</a></h2>
        <div>
            @foreach($subjects as $subject)
                <div class="subject-div row">
                    <h3 class="subject-name col-12">名前:{{ $subject->name }} 学籍番号:{{ $subject->uni_id }}</h3>
                    @foreach ($quizzes as $index => $quiz)
                        <div class="col-12">
                            問{{ $index + 1 }}
                            @foreach($subject->tracks()->where('quiz_id', $quiz->id)->get() as $track)
                                @if ($track->category_id != null)
                                    <span class="track_category_good">{{ $track->category_id }}: {{ $track->category->name }}</span>
                                    ->
                                @elseif ($track->content_id != null)
                                    <span class="track_content_good">{{ $track->content_id }}: {{ $track->content->name }}</span>
                                @else
                                    <span class="track_content_bad">諦めた</span>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
