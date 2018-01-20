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
        <h2>{{ $subject->name }}さんの結果 <a href="{{ action('AdminController@getSubjectResults') }}">みんなの結果へ戻る</a></h2>
        <div>
            学籍番号:{{ $subject->uni_id }} 性別:
                        @if($subject->sex == 1)
                            男性
                        @else
                            女性
                        @endif
                         料理の得意度:{{ $subject->experience }}
        </div>
        <div>
            @foreach ($quizzes as $index => $quiz)
                <div class="subject-div row">
                        @if($subject->time_tracks()->where('quiz_id', $quiz->id)->exists())
                        <div class="col-12">
                            問{{ $index + 1 }}
                            @if (fmod($subject->id + $index, 2) == 0)
                                (木)
                            @else
                                (セ)
                            @endif
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
                            <span class="time_track">時間:{{ $subject->time_tracks()->where('quiz_id', $quiz->id)->first()->time }}秒</span>
                        </div>
                        @endif
                </div>
            @endforeach
                <div class="subject-div row">
                    <div class="col-12">
                        <div>
                            アンケート
                        </div>
                        <div>
                            AとBの違いはわかったか: {{ $questionnaire->question1 . ',' . $questionnaire->answer1 }}
                        </div>
                        <div>
                            違いはどのくらいあるか: {{ $questionnaire->question2 . ',' . $questionnaire->answer2 }}
                        </div>
                        <div>
                            何が違うと思うか: {{ $questionnaire->question3 }}
                        </div>
                        <div>
                            AとBではどちらが探しやすいか: {{ $questionnaire->question4 . ',' . $questionnaire->answer4 . ', ' .$questionnaire->answer4text }}
                        </div>
                        <div>
                            AとBではどちらが操作しやすいか: {{ $questionnaire->question5 . ',' . $questionnaire->answer5 . ', ' . $questionnaire->answer5text }}
                        </div>
                        <div>
                            AとBではどちらが疲れやすいか: {{ $questionnaire->question6 . ',' . $questionnaire->answer6 . ', ' . $questionnaire->answer6text }}
                        </div>
                        <div>
                            AとBではどちらが効率がよいか: {{ $questionnaire->question7 . ',' . $questionnaire->answer7 . ', ' . $questionnaire->answer7text }}
                        </div>
                        <div>
                            システムの評価: {{ $questionnaire->question8 . ',' . $questionnaire->answer8 . ', ' . $questionnaire->answer8text }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
