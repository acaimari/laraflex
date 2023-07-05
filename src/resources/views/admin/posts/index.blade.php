@extends('laraflex::layouts.admin')

@section('content')


<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="far fa-newspaper"></i> Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('posts.create') }}">Add New</a></li>
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

    <!-- Añadir buscador -->
    <div class="mb-3">
            <form id="searchForm">
                <input type="text" id="searchInput" placeholder="Search...">
                <button type="submit">Search</button>
                <button type="button" id="resetButton">Reset</button>
            </form>
    </div>

    <!-- Tabla -->
<table class="table table-bordered" id="resultsTable">
    <thead>
        <tr>
        <th class="sortable" data-sort="title">
        Title
        <i class="fas fa-chevron-up"></i>
        <i class="fas fa-chevron-down"></i>
        </th>



            <th>Categories</th>
            <th>Tags</th>
            <th>Visitors</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
            <td>
            <a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a>
            @if ($post->id === $setHomePost->content_id && $setHomePost->content_type === 'post')
                <small>— This is Front Page</small>
            @endif
        </td>
                



                <td>
                    @foreach ($post->categories as $key => $category)
                        {{ $category->title }}
                        @if ($key < count($post->categories) - 1)
                            ,
                        @endif
                    @endforeach
                </td>
                
                <td>
                    @foreach ($post->tags as $key => $tag)
                        {{ $tag->title }}
                        @if ($key < count($post->tags) - 1)
                            ,
                        @endif
                    @endforeach
                </td>
                
                <td>{{ $post->uniqueViews }}</td>

                <td>{{ $post->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('posts.edit', $post->id) }}">
                            <button>
                                <i class="mdi mdi-note-edit-outline"></i>
                            </button>
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this post?')">
                            @csrf
                            @method('POST')
                            <button type="submit">
                                <i class="mdi mdi-trash-can-outline"></i>
                            </button>
                        </form>

                        <button onclick="window.open('{{ route('post.show', $post->slug) }}', '_blank')">
                        <i class="mdi mdi-eye-arrow-right-outline"></i>
                        </button>

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    <!-- Paginación -->
    {{ $posts->links('laraflex::vendor.pagination.bootstrap-5') }}
</div>



<script>
    var currentSortField = '';
    var currentSortDirection = 'asc';

    function executeSearch() {
        var searchValue = $('#searchInput').val();

        $.ajax({
            url: '{{ route('posts.ajaxSearch') }}',
            type: 'GET',
            data: {
                search: searchValue,
                sortField: currentSortField,
                sortDirection: currentSortDirection
            },
            success: function(response) {
                // Actualizar la tabla de resultados con los datos devueltos
                var tableBody = $('#resultsTable tbody');
                tableBody.empty();

                $.each(response, function(index, post) {
                    var row = '<tr>' +
                        '<td>' +
                        '<a href="' + '{{ route('posts.edit', 'id') }}'.replace('id', post.id) + '">' +
                        post.title +
                        '</a>' +
                        '</td>' +
                        '<td>';
                            
                        
                        if(post.categories) {
                        $.each(post.categories, function(index, category) {
                            row += category.title;

                            if (index < post.categories.length - 1) {
                                row += ', ';
                            }
                        });
                    }

                    row += '</td>' +
                        '<td>';


                    if(post.tags) {
                        $.each(post.tags, function(index, tag) {
                            row += tag.title;

                            if (index < post.tags.length - 1) {
                                row += ', ';
                            }
                        });
                    }

                        row += '</td>' +
                            '<td>' + (post.status ? 'Active' : 'Inactive') + '</td>' +
                            '<td>' +
                            '<div class="d-flex">' +
                            '<a href="' + '{{ route('posts.edit', 'id') }}'.replace('id', post.id) + '">' +
                            '<button>' +
                            '<i class="mdi mdi-note-edit-outline"></i>' +
                            '</button>' +
                            '</a>' +
                            '<form action="' + '{{ route('posts.destroy', 'id') }}'.replace('id', post.id) + '" method="POST" onsubmit="return confirm(\'Are you sure to delete this post?\')">' +
                            '<input type="hidden" name="_method" value="POST" />' +
                            '@csrf' +
                            '<button type="submit">' +
                            '<i class="mdi mdi-trash-can-outline"></i>' +
                            '</button>' +
                            '</form>' +
                            '<button onclick="window.open(\'{{ route('post.show', 'slug') }}'.replace('slug', post.slug) + '\', \'_blank\')">' +
                            '<i class="mdi mdi-eye-arrow-right-outline"></i>' +
                            '</button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';

                        tableBody.append(row);

                });
            }
        });
    }

            $(document).ready(function() {
                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();

                    executeSearch();
                });

                $('#resetButton').click(function() {
                    window.location.href = '{{ route('posts.index') }}';
                });

                $('.sortable').click(function() {
    var sortField = $(this).data('sort');
    var sortDirection = (currentSortField == sortField && currentSortDirection == 'asc') ? 'desc' : 'asc';

    // Actualiza las variables globales
    currentSortField = sortField;
    currentSortDirection = sortDirection;

    // Elimina cualquier indicador de orden existente
    $('.sortable i').removeClass('fas fa-chevron-up fa-chevron-down');

    // Añade el indicador de orden correcto
    if (sortDirection == 'asc') {
        $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
        $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }

    // Ejecuta la búsqueda con el nuevo ordenamiento
    executeSearch();
});


});
</script>





@endsection
