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
        .track_category_semilattice {
            color: purple;
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
                    <h3 class="subject-name col-12">名前:{{ $subject->name }} 学籍番号:{{ $subject->uni_id }}
                    性別:
                        @if($subject->sex == 1)
                            男性
                        @else
                            女性
                        @endif
                         料理の得意度:{{ $subject->experience }}
                         アンケート:
                        @if($subject->questionnaire != null)
                            {{ $subject->questionnaire->question1 }}
                        @endif
                        <a href="{{ action('AdminController@getSubjectResult', [$subject->id]) }}">詳しいページへ</a>
                        <form action="{{ action('AdminController@postDeleteSubject') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            {{--<button action="submit" id="delete_button" class="btn btn-danger">削除</button>--}}
                        </form>
                    </h3>
                    @foreach ($quizzes as $index => $quiz)
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
                                    @if ($track->category->is_semilattice_category)
                                        <span class="track_category_semilattice">{{ $track->category_id }}: {{ $track->category->name }}</span>
                                    @else
                                        <span class="track_category_good">{{ $track->category_id }}: {{ $track->category->name }}</span>
                                    @endif
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
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $('#delete_button').click(function(){
                if(!confirm('本当に消しますか？')) {
                    return false;
                }
            });
        });
    </script>
@endsection
