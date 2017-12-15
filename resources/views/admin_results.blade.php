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
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>みんなの結果</h2>
        <div>
            @foreach($subjects as $subject)
                <div class="subject-div row">
                    <h3 class="subject-name col-12">名前:{{ $subject->name }} 学籍番号:{{ $subject->uni_id }}</h3>
                    @for ($quiz_num = 1; $quiz_num <= 2; $quiz_num++)
                        <div class="col-12">
                            問{{ $quiz_num }}
                            @foreach($subject->tracks()->where('quiz_num', $quiz_num)->get() as $track)
                                @if ($track->category_id != null)
                                    {{ $track->category_id }}->
                                @elseif ($track->content_id != null)
                                    {{ $track->content_id }}
                                @else
                                    諦めた
                                @endif
                            @endforeach
                        </div>
                    @endfor
                </div>
            @endforeach
        </div>
    </div>
@endsection