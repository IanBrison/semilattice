@extends('base')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = window.Laravel || {};
        window.Laravel.csrfToken = "{{csrf_token()}}";
    </script>
@endsection

@section('body')
    <div id="app">
        <semilattice></semilattice>
    </div>
@endsection

@section('script')
    <script src="/js/app.js"></script>
@endsection