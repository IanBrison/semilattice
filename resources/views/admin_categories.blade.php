@extends('base')

@section('title', 'カテゴリ一覧')

@section('body')
    <canvas width="1800" height="8000" style="position: absolute;">
    </canvas>
    <h1>カテゴリ一覧</h1>
    <div class="container-fluid">
        <form action="{{ action('AdminController@createCategory') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="カテゴリ名" required>
            <input type="number" name="parent_id" placeholder="親カテゴリID" required>
            <input type="hidden" name="type" value="1" required>
            <button type="submit">作成</button>
        </form>
        <div class="row">
            @foreach($category_layers as $category_layer)
                <div class="col-md-2">
                    @foreach($category_layer as $category)
                        <div><span id="category{{ $category->id }}">{{ $category->id . ': ' . $category->name }}</span></div>
                        <script type="text/javascript">
                            @foreach($category->parents as $parent)
                                $("canvas").drawLine({
                                    strokeStyle: "black",
                                    strokeWidth: 1,
                                    x1: $("#category{{ $parent->id }}").offset().left + $("#category{{ $parent->id }}").outerWidth() + 3,
                                    y1: $("#category{{ $parent->id }}").offset().top + $("#category{{ $parent->id }}").outerHeight() / 2,
                                    x2: $("#category{{ $category->id }}").offset().left - 3,
                                    y2: $("#category{{ $category->id }}").offset().top + $("#category{{ $category->id }}").outerHeight() / 2
                                });
                            @endforeach
                        </script>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection