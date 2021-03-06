@extends('base')

@section('head')
    <style>
        h2 {
            margin: 8px 8px 8px 0px;
        }
        h3 {
            margin: 8px 8px 8px 0px;
        }
        .exp-group {
            margin-bottom: 10px;
        }
        .pagination {
            width: fit-content;
            margin: 0px auto 50px;
        }
        #current_category {
            font-size: 20px;
        }
        #give_up {
            color: red;
            font-size: 20px;
        }
        .page-item > a {
            margin-top: 0;
        }
        .card-background {
            background-color: gray;
        }
        .title {
            padding: 9px 9px 0px 9px;
        }

        .ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            /*white-space: nowrap;*/
            word-wrap: break-word;
        }

        .flex-wrap-center {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .thumbnail-ratio-wrapper {
            position: relative;
            padding-top: 75%;
            display: block;
        }

        .thumbnail-size-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .content {
            background: #F2F2F2;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0px 0px 20px 0px;
            padding: 10px;
            text-align: center;
        }

        .target_content {
            background: #F2F2F2;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
        }

        .content:hover {
            opacity: 0.5;
            text-decoration: underline;
        }

        .content-link {
            position: absolute;
            top: 0;
            left: 15px;
            right: 15px;
            bottom: 20px;
        }

        .content-thumbnail {
            height: 100%;
            position: relative;
            background-color: #FFFFFF;
        }

        .content-image {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: none;
        }

        /*thumb*/

        .content-detail {
            /*padding: 0px 9px 9px 9px;*/
        }

        .content-title {
            /*border-bottom: 1px dotted #cccccc;*/
            font-size: large;
            margin: 0px 0px 5px 0px;
            /*padding: 0px 0px 2px 5px;*/
        }

        .content-tags {
            height: 40px;
            margin: 0px;
            width: 100%;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12 exp-group">
                <h3>お題</h3>
                <div class="target_content">
                    <div class="title">
                        <p class="content-title ellipsis">{{ $quiz->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 exp-group">
                <h3>カテゴリ<br><a id="current_category">{{ $category->name }}</a></h3>
                @if($category->id != 1)
                    <a href="{{ action('ExperimentController@getExperiment', [$quiz_num, 1]) }}">カテゴリトップに戻る</a>
                @endif
                <div class="list-group">
                    <div class="row" style="margin: 0px;">
                @foreach ($childs as $child)
                    <a class="list-group-item list-group-item-activate col-6 col-sm-4 col-lg-3" href="{{ action('ExperimentController@getExperiment', [$quiz_num, $child->id]) }}">
                        {{ $child->name }}
                        @if($child->pivot->semilattice_name != null)
                            （{{ $child->pivot->semilattice_name }}）
                        @endif
                    </a>
                @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3>料理（{{ $contents->total() }}）<br><a id="give_up" href="{{ action('ExperimentController@getResult', [$quiz_num, 0]) }}">どうしても見つからない</a></h3>
            </div>
            @foreach ($contents as $content)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="content">
                        <div class="content-box">
                            <div class="thumbnail-ratio-wrapper">
                                <div class="thumbnail-size-wrapper">
                                    <div class="content-thumbnail">
                                        <img class="content-image thumbnail" src="{{ '/rakuten_images/' . $content->img_url }}">
                                    </div>
                                </div>
                            </div>
                            <div class="title">
                                <p class="content-title ellipsis">{{ $content->name }}</p>
                            </div>
                        </div>
                        <a href="{{ action('ExperimentController@getResult', [$quiz_num, $content->id]) }}" class="content-link"></a>
                    </div>
                </div>
            @endforeach
            {{ $contents->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $('.content-link').click(function(){
                if(!confirm('こちらの料理で確定になりますがよろしいですか？')) {
                    return false;
                }
            });
            $('#give_up').click(function(){
                if(!confirm('次の問題にいきますがよろしいですか？')) {
                    return false;
                }
            });
        });
    </script>
@endsection
