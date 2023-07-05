@extends('laraflex::layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="far fa-list-alt"></i> Post Categories</h1>
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
        <a href="{{ route('post-categories.create') }}" class="btn btn-primary">Create New Category</a>
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
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->status == 0 ? 'Inactive' : 'Active' }}</td>
                        <td>

    <div class="d-flex">
                
    <a href="{{ route('post-categories.edit', $category->id) }}">
         <button><i class="mdi mdi-pencil-outline"></i></button>
    </a>

    <form action="{{ route('post-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this category?')">
        @csrf
        @method('DELETE')
        <button type="submit">
            <i class="mdi mdi-trash-can-outline"></i>
        </button>
    </form>
    <a href="{{ route('category.show', $category->slug) }}" target="_blank">
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

