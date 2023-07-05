@extends('laraflex::layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-tags"></i> Create Post Tag</h1>
    <ol class="breadcrumb mb-4"></ol>

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('post.tags.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div> <!-- End Left column -->
        </div> <!-- End Row -->
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#title").keyup(function(){
        var str = $(this).val();
        var slug = str
            .toLowerCase()
            .replace(/[áàäâãå]/g, 'a')
            .replace(/[éèëê]/g, 'e')
            .replace(/[íìïî]/g, 'i')
            .replace(/[óòöôõø]/g, 'o')
            .replace(/[úùüû]/g, 'u')
            .replace(/[ñ]/g, 'n')
            .replace(/[^a-z0-9]/g, '-')
            .replace(/^-+|-+$/g, '');
        $("#slug").val(slug);
    });
});
</script>

@endsection
