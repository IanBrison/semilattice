@extends('base')

@section('title', 'カテゴリ一覧')

@section('body')
    <canvas width="1800" height="8000" style="position: absolute; top: 117px;">
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
        <div class="row">
            @foreach($category_layers as $category_layer)
                <div class="col-md-2">
                    @foreach($category_layer as $category)
                        <div><span id="category{{ $category->id }}">{{ $category->id . ': ' . $category->name }}</span></div>
                        <script type="text/javascript">
                            @foreach($category->parent_connections as $connection)
                                $("canvas").drawLine({
                                    @if ($connection->types[0]->type == 1)
                                    strokeStyle: "black",
                                    @elseif ($connection->types[0]->type== 2)
                                    strokeStyle: "blue",
                                    @endif
                                    strokeWidth: 1,
                                    x1: $("#category{{ $connection->parent_category_id }}").offset().left + $("#category{{ $connection->parent_category_id }}").outerWidth() + 3,
                                    y1: $("#category{{ $connection->parent_category_id }}").offset().top + $("#category{{ $connection->parent_category_id }}").outerHeight() / 2 - 117,
                                    x2: $("#category{{ $category->id }}").offset().left - 3,
                                    y2: $("#category{{ $category->id }}").offset().top + $("#category{{ $category->id }}").outerHeight() / 2 - 117
                                });
                            @endforeach
                        </script>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection