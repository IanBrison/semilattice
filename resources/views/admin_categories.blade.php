@extends('base')

@section('body')
    <h1>カテゴリ一覧</h1>
    <div>
        <form action="{{ action('AdminController@createCategory') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="カテゴリ名" required>
            <input type="number" name="parent_id" placeholder="親カテゴリID" required>
            <input type="hidden" name="type" value="1" required>
            <button type="submit">作成</button>
        </form>
        @foreach(\App\Category::all() as $category)
            <p>{{ $category->id . ': ' . $category->name }}</p>
        @endforeach
    </div>
@endsection