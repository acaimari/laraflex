@extends('laraflex::layouts.admin')

@section('content')

@auth
    <div class="container-fluid px-4">
    <h1 class="mt-4"><i class="far fa-file-alt"></i> Pages</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('pages.create') }}">Add New</a></li>
    </ol>


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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Lang</th>
                <th>Visitors</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($pages as $page)
            <tr>
            

            <td>
            <a href="{{ route('pages.edit', $page->id) }}">{{ $page->title }}</a>
            @if ($page->id === $setHomePage->content_id && $setHomePage->content_type === 'page')
                <small>— This is Front Page</small>
            @endif
          </td>


                <td>{{ $page->slug }}</td>
                <td>{{ $page->lang }}</td>
                <td>{{ $page->uniqueViews }}</td>
                <td>

                <div class="d-flex">
                <a href="{{ route('pages.edit', $page->id) }}">
    <button>
        <i class="mdi mdi-note-edit-outline"></i>
    </button>
</a>


<form action="{{ route('pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this page?')">
@csrf
@method('POST')
<button type="submit"><i class="mdi mdi-trash-can-outline"></i></button>
</form>


<button onclick="window.open('{{ route('page.show', $page->slug) }}', '_blank')">
    <i class="mdi mdi-eye-arrow-right-outline"></i>
</button>


</div>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



  <!-- Paginación -->
  {{ $pages->links('laraflex::vendor.pagination.bootstrap-5') }}


</div>



@endauth
@endsection
