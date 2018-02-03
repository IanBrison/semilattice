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
            @php
            $all_times = collect();
            $tree_times = collect();
            $semi_times = collect();
            $all_clicks = collect();
            $tree_clicks = collect();
            $semi_clicks = collect();
            $all_medium_clicks = collect();
            $pre_id = 0;
            @endphp
            @foreach ($quizzes as $index => $quiz)
                <div class="subject-div row">
                        @if($subject->time_tracks()->where('quiz_id', $quiz->id)->exists())
                        <div class="col-12">
                            問{{ $index + 1 }}
                            @if (fmod($subject->id + $index, 2) == 0)
                                (木)
                                @php
                                $all_clicks->push(0);
                                $tree_clicks->push(0);
                                $semi_clicks->push(0);
                                $all_medium_clicks->push(0);
                                @endphp
                            @else
                                (セ)
                                @php
                                $all_clicks->push(0);
                                $tree_clicks->push(0);
                                $semi_clicks->push(0);
                                $all_medium_clicks->push(0);
                                @endphp
                            @endif
                            @php
                            $pre_id = 0;
                            @endphp
                            @foreach($subject->tracks()->where('quiz_id', $quiz->id)->get() as $track)
                                @if ($track->category_id != null)
                                    @if ($track->category->is_semilattice_category)
                                        <span class="track_category_semilattice">{{ $track->category_id }}: {{ $track->category->name }}</span>
                                        @php
                                        if ($pre_id != $track->category_id) {
                                            $all_clicks[$all_clicks->count() - 1] = $all_clicks[$all_clicks->count() - 1] + 1;
                                            $semi_clicks[$semi_clicks->count() - 1] = $semi_clicks[$semi_clicks->count() - 1] + 1;
                                            if (($parent_con = $track->category->parents()->first()->parent_connections()->first()) != null && $parent_con->parent_category_id == 1){
                                                $all_medium_clicks[$all_medium_clicks->count() - 1] = $all_medium_clicks[$all_medium_clicks->count() - 1] + 1;
                                            }
                                        }
                                        $pre_id = $track->category_id;
                                        @endphp
                                    @else
                                        <span class="track_category_good">{{ $track->category_id }}: {{ $track->category->name }}</span>
                                        @php
                                        if ($pre_id != $track->category_id) {
                                            $all_clicks[$all_clicks->count() - 1] = $all_clicks[$all_clicks->count() - 1] + 1;
                                            $tree_clicks[$tree_clicks->count() - 1] = $tree_clicks[$tree_clicks->count() - 1] + 1;
                                            if (($parent_con = $track->category->parents()->first()->parent_connections()->first()) != null && $parent_con->parent_category_id == 1){
                                                $all_medium_clicks[$all_medium_clicks->count() - 1] = $all_medium_clicks[$all_medium_clicks->count() - 1] + 1;
                                            }
                                        }
                                        $pre_id = $track->category_id;
                                        @endphp
                                    @endif
                                    ->
                                @elseif ($track->content_id != null)
                                    <span class="track_content_good">{{ $track->content_id }}: {{ $track->content->name }}</span>
                                @else
                                    <span class="track_content_bad">諦めた</span>
                                @endif
                            @endforeach
                            <span class="time_track">時間:{{ $time = $subject->time_tracks()->where('quiz_id', $quiz->id)->first()->time }}秒</span>
                            @php
                            if(fmod($subject->id + $index, 2) == 0) {
                                $all_times->push($time);
                                $tree_times->push($time);
                            } else {
                                $all_times->push($time);
                                $semi_times->push($time);
                            }
                            @endphp
                        </div>
                        @endif
                </div>
            @endforeach
            @php
            $total_score = $questionnaire->question4 + $questionnaire->question5 - $questionnaire->question6 + $questionnaire->question7 - 6;
            if(fmod($subject->id, 2) == 0) $total_score *= -1;
            $semi_num = fmod($subject->id + 1, 2);
            $semi_per = collect();
            $semi_per_all = 0;
            $semi_medium_per = collect();
            $semi_medium_per_all = 0;
            $semi_per_all_clicks = 0;
            $semi_per_medium_clicks = 0;
            $semi_per_semi_clicks = 0;
            for($num = $semi_num; $num < count($quizzes); $num += 2) {
                $semi_per_all_clicks += $all_clicks[$num];
                $semi_per_medium_clicks += $all_medium_clicks[$num];
                $semi_per_semi_clicks += $semi_clicks[$num];
                $semi_per->push(round($semi_clicks[$num] * 100 / $all_clicks[$num]));
                if ($all_medium_clicks[$num] == 0) $all_medium_clicks[$num] = 1;
                $semi_medium_per->push(round($semi_clicks[$num] * 100 / $all_medium_clicks[$num]));
            }
            if ($semi_per_medium_clicks == 0) $semi_per_medium_clicks = 1;
            @endphp
                <div class="subject-div row">
                    <div class="col-12">
                        <div>スタッツ</div>
                    </div>
                    <div class="col-6">全体の平均回答時間</div><div class="col-6">{{ $all_times->sum() / count($quizzes) }}秒 ({{ $all_times->implode(', ') }})</div>
                    <div class="col-6">木構造の平均回答時間</div><div class="col-6">{{ $tree_times->sum() * 2 / count($quizzes) }}秒 ({{ $tree_times->implode(', ') }})</div>
                    <div class="col-6">セミラティス構造の平均回答時間</div><div class="col-6">{{ $semi_times->sum() * 2 / count($quizzes) }}秒 ({{ $semi_times->implode(', ') }})</div>
                    <div class="col-6">全体のカテゴリのクリック数</div><div class="col-6">{{ $all_clicks->sum() }}回 ({{ $all_clicks->implode(", ") }})</div>
                    <div class="col-6">ノーマルカテゴリののクリック数</div><div class="col-6">{{ $tree_clicks->sum() }}回 ({{ $tree_clicks->implode(", ") }})</div>
                    <div class="col-6">中カテゴリのクリック数</div><div class="col-6">{{ $all_medium_clicks->sum() }}回 ({{ $all_medium_clicks->implode(", ") }})</div>
                    <div class="col-6">セミラティスカテゴリのクリック数</div><div class="col-6">{{ $semi_clicks->sum() }}回 ({{ $semi_clicks->implode(", ") }})</div>
                    <div class="col-6">セミラティスカテゴリのクリック率</div><div class="col-6">{{ round($semi_per_semi_clicks * 100 / $semi_per_all_clicks) }}% ({{ $semi_per->implode('%, ') }}%)</div>
                    <div class="col-6">セミラティスカテゴリのクリック率（中カテゴリのみ）</div><div class="col-6">{{ round($semi_per_semi_clicks * 100 / $semi_per_medium_clicks) }}% ({{ $semi_medium_per->implode('%, ') }}%)</div>
                    <div class="col-6">アンケート評価（セミラティスの良さ）</div><div class="col-6">{{ $total_score }}ポイント</div>
                    <div class="col-6">CSV用</div><div class="col-6">{{ $all_times->sum() / count($quizzes) . ', ' . $all_times->implode(', ') . ', ' . $tree_times->sum() * 2 / count($quizzes) . ', '
                    . $tree_times->implode(', ') . ', ' . $semi_times->sum() * 2 / count($quizzes) . ', ' . $semi_times->implode(', ') . ', ' . $all_clicks->sum() . ', ' . $all_clicks->implode(", ") . ', '
                    . $tree_clicks->sum() . ', ' . $tree_clicks->implode(", ") . ', ' . $all_medium_clicks->sum() . ', ' . $all_medium_clicks->implode(", ") . ', ' . $semi_clicks->sum() . ', '
                    . $semi_clicks->implode(", ") . ', ' . round($semi_per_semi_clicks * 100 / $semi_per_all_clicks) . ', ' . $semi_per->implode(', ') . ', ' . round($semi_per_semi_clicks * 100 / $semi_per_medium_clicks) . ', '
                    . $semi_medium_per->implode(', ') . ', ' . $total_score }}</div>
                </div>

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
