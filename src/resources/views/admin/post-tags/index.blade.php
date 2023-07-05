@extends('laraflex::layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-tags"></i> Post Tags</h1>
    <ol class="breadcrumb mb-4"></ol>

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {!! session('error') !!}
    </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('post.tags.create') }}" class="btn btn-primary">Create New Tag</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->status == 0 ? 'Inactive' : 'Active' }}</td>
                        <td>

                            <div class="d-flex">
    <a href="{{ route('post.tags.edit', $tag->id) }}">
        <button><i class="mdi mdi-pencil-outline"></i></button>
    </a>
    <form action="{{ route('post.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?')">
        @csrf
        @method('DELETE')
        <button type="submit">
            <i class="mdi mdi-trash-can-outline"></i>
        </button>
    </form>
    <a href="{{ route('tag.show', $tag->slug) }}" target="_blank">
        <button><i class="mdi mdi-eye-arrow-right-outline"></i></button>
    </a>
</div>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
