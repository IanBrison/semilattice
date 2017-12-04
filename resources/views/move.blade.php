@extends('base')

@section('body')
    <div class="container">
        <ul>
            @foreach ($categorylinks as $categorylink)
                <li>
                    {{ $categorylink->page->page_title }}
                    <strong>{{ $categorylink->cl_type }}</strong>
                </li>
            @endforeach
        </ul>
    </div>
@endsection