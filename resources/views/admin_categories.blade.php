@extends('base')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jcanvas/20.1.4/min/jcanvas.min.js"></script>
@endsection

@section('title', 'カテゴリ一覧')

@section('body')
    <canvas width="3600" height="32000" style="position: absolute;">
    </canvas>
    <div class="container-fluid">
        <div class="row">
            @foreach($category_layers as $category_layer)
                <div class="col-md-2" style="padding: 0;">
                    @foreach($category_layer as $category)
                        <div onclick="semi(1, {{ $category->parent_connection_to_array }}, {{ $category->id }}, {{ $category->child_connection_to_array }})"><span id="category{{ $category->id }}">{{ $category->id }}: {{ $category->name }}</span></div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        function semi(color, a_ids, b_id, c_ids){
            if (color == 1){
                for(var i = 0; i < a_ids.length; i++)
                {
                    $("canvas").drawLine({
                        strokeStyle: "black",
                        strokeWidth: 1,
                        x1: $("#category" + a_ids[i]).offset().left + $("#category" + a_ids[i]).outerWidth() + 3,
                        y1: $("#category" + a_ids[i]).offset().top + $("#category" + a_ids[i]).outerHeight() / 2,
                        x2: $("#category" + b_id).offset().left - 3,
                        y2: $("#category" + b_id).offset().top + $("#category" + b_id).outerHeight() / 2
                    });
                }
                for(var i = 0; i < c_ids.length; i++)
                {
                    $("canvas").drawLine({
                        strokeStyle: "black",
                        strokeWidth: 1,
                        x1: $("#category" + b_id).offset().left + $("#category" + b_id).outerWidth() + 3,
                        y1: $("#category" + b_id).offset().top + $("#category" + b_id).outerHeight() / 2,
                        x2: $("#category" + c_ids[i]).offset().left - 3,
                        y2: $("#category" + c_ids[i]).offset().top + $("#category" + c_ids[i]).outerHeight() / 2
                    });
                }
            }
        }
    </script>
@endsection