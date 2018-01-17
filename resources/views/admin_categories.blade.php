@extends('base')

@section('title', 'カテゴリ一覧')

@section('body')
    <canvas width="1800" height="32000" style="position: absolute; top: 177px;">
    </canvas>
    <h1>カテゴリ一覧</h1>
    <div class="container-fluid">
        <form action="{{ action('AdminController@createCategory') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="カテゴリ名" required>
            <input type="number" name="parent_id" placeholder="親カテゴリID" required>
            <input type="hidden" name="category_type" value="1" required>
            <input type="number" name="connection_type" placeholder="接続タイプ" required>
            <button type="submit">作成</button>
        </form>
        <form action="{{ action('AdminController@createConnection') }}" method="POST">
            {{ csrf_field() }}
            <input type="number" name="parent_id" placeholder="親カテゴリID" required>
            <input type="number" name="child_id" placeholder="子カテゴリID" required>
            <input type="number" name="connection_type" placeholder="接続タイプ" required>
            <button type="submit">接続</button>
        </form>
        <form action="{{ action('AdminController@createContent') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="コンテンツ名" required>
            <input type="number" name="category_id" placeholder="カテゴリID" required>
            <button type="submit">作成</button>
        </form>
        <form action="{{ action('AdminController@createCategoryContent') }}" method="POST">
            {{ csrf_field() }}
            <input type="number" name="category_id" placeholder="カテゴリID" required>
            <input type="number" name="content_id" placeholder="コンテンツID" required>
            <button type="submit">作成</button>
        </form>
        <div class="row">
            @foreach($category_layers as $category_layer)
                <div class="col-md-1" style="padding: 0;">
                    @foreach($category_layer as $category)
                        <div><span id="category{{ $category->id }}">{{ $category->id }}</span></div>
                        <script type="text/javascript">
                            @foreach($category->parent_connections as $connection)
                                $("canvas").drawLine({
                                    strokeStyle: "black",
                                    strokeWidth: 1,
                                    x1: $("#category{{ $connection->parent_category_id }}").offset().left + $("#category{{ $connection->parent_category_id }}").outerWidth() + 3,
                                    y1: $("#category{{ $connection->parent_category_id }}").offset().top + $("#category{{ $connection->parent_category_id }}").outerHeight() / 2 - 177,
                                    x2: $("#category{{ $category->id }}").offset().left - 3,
                                    y2: $("#category{{ $category->id }}").offset().top + $("#category{{ $category->id }}").outerHeight() / 2 - 177
                                });
                            @endforeach
                        </script>
                    @endforeach
                </div>
            @endforeach
                <div class="col-md-2">
                    @foreach($contents as $content)
                        <div><span id="content{{ $content->id }}">{{ $content->id }}</span></div>
                        <script type="text/javascript">
                            @foreach($content->last_categories as $last_category)
                                $("canvas").drawLine({
                                    strokeStyle: "red",
                                    strokeWidth: 1,
                                    x1: $("#category{{ $last_category->id }}").offset().left + $("#category{{ $last_category->id }}").outerWidth() + 3,
                                    y1: $("#category{{ $last_category->id }}").offset().top + $("#category{{ $last_category->id }}").outerHeight() / 2 - 177,
                                    x2: $("#content{{ $content->id }}").offset().left - 3,
                                    y2: $("#content{{ $content->id }}").offset().top + $("#content{{ $content->id }}").outerHeight() / 2 - 177
                                });
                            @endforeach
                        </script>
                    @endforeach
                </div>
        </div>
    </div>
@endsection
