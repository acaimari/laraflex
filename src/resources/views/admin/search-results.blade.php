@extends('laraflex::layouts.admin')

@section('content')

<div class="container-fluid px-4">
    @php
        $foundResults = false;
    @endphp

    @if (count($pages) > 0 && $pages->contains(function ($page) use ($searchTerm) {
        return stripos($page->title, $searchTerm) !== false;
    }))
        @php
            $foundResults = true;
        @endphp
        <h3>Páginas</h3>
        <ul>
            @foreach ($pages as $page)
                @if (stripos($page->title, $searchTerm) !== false)
                    <li>{{ $page->title }}</li>
                @endif
            @endforeach
        </ul>
    @endif

    @if (count($posts) > 0 && $posts->contains(function ($post) use ($searchTerm) {
        return stripos($post->title, $searchTerm) !== false;
    }))
        @php
            $foundResults = true;
        @endphp
        <h3>Posts</h3>
        <ul>
            @foreach ($posts as $post)
                @if (stripos($post->title, $searchTerm) !== false)
                    <li>{{ $post->title }}</li>
                @endif
            @endforeach
        </ul>
    @endif

    @if (!$foundResults)
        <p>No results found.</p>
    @endif
</div>
@endsection

