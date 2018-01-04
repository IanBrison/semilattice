@extends('base')

@section('head')
    <style>
        h2 {
            margin: 8px 8px 8px 0px;
        }
        h3 {
            font-size: 20px;
        }
        h4 {
            font-size: 15px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>実験終了</h2>
        <div>
            <h4>
                ご協力ありがとうございました。実験は以上で終了です。
            </h4>
        </div>
        <a href="{{ route('login') }}">はじめに戻る</a>
    </div>
@endsection