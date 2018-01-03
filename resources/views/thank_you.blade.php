@extends('base')

@section('body')
    <div class="container">
        <h2>実験終了</h2>
        <div>
            ご協力ありがとうございました。実験は以上で終了です。
        </div>
        <a href="{{ route('top') }}">はじめに戻る</a>
    </div>
@endsection