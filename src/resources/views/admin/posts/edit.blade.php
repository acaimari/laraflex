@extends('laraflex::layouts.admin')

@section('content')

<style>

#remove-image {
    background: #f44336;
    color: white;
    border: none;
    border-radius: 50%;
    padding: 0 0.5em;
    cursor: pointer;
}

</style>

<div class="container-fluid px-4">

    <div class="row">
        <div class="col-md-9">
            <h1>Edit Post</h1>

            <div class="margin"></div>

            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug }}">
                </div>


<!-- CKeditor -->
    <div class="mb-3">
    <label for="postcontent" class="form-label">Content</label>
    <textarea cols="80" id="postcontent" name="content" rows="10">{{ $post->content }}</textarea>
    </div>


<div class="margin"></div>

<button id="set-home-page" class="btn{{ $isHomePost ? ' btn-primary' : ' btn-secondary' }}" {{ $isHomePost ? 'disabled' : '' }}>
    @if ($isHomePost)
        This is the home page
    @else
        Set as home page
    @endif
</button>
 
<div class="margin"></div>




                </div>  <!-- End Left column -->
        
 <!---------------------------------------------------------------------->
        
        <div class="col-md-3"> <!-- Right column -->


        <!----------------- Edit Cards ---------------------------->

<!-- Publish Edit Card -->
<div class="card mb-3">
    <div class="card-header" id="headingZero">
        <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left no-link-decoration collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
                Publish
            </button>
        </h2>
    </div>

    <div id="collapseZero" class="collapse show" aria-labelledby="headingZero" data-bs-parent="#accordionExample">
        <div class="card-body">

        <div class="margin"></div>

        <label for="status" class="form-label">Status</label>
<select class="form-control" id="status" name="status">
    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
</select>



            <div class="margin"></div>

            <div class="mb-3">
    <label for="sidebar_position" class="form-label">View format (Sidebar)</label>
    <select class="form-control" id="sidebar_position" name="sidebar_position">
                    <option value="left" {{ $post->sidebar_position == 'left' ? 'selected' : '' }}>Left</option>
                    <option value="right" {{ $post->sidebar_position == 'right' ? 'selected' : '' }}>Right</option>
                    <option value="none" {{ $post->sidebar_position == 'none' ? 'selected' : '' }}>None</option>
    </select>
</div>


    <div class="margin"></div>

    <div class="d-flex flex-wrap justify-content-between">

                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-outline"></i> Save
                    </button>
                    <a href="{{ route('post.show', $post->slug) }}" target="_blank" class="btn btn-success">
                        <i class="mdi mdi-eye-arrow-right-outline"></i> View
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-exit-run"></i> Exit
                    </a>
                </div>

</div>





        </div>
    </div>
</div>





<!-- Categorías -->
<div class="card mb-3">
    <div class="card-header" id="headingOne">
        <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left no-link-decoration" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Categories
            </button>
        </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="card-body">

        <input name="categories" id="tagify-categories" placeholder="Enter categories" value="{{ implode(',', $post->categories->pluck('title')->toArray()) }}">

<script>
    var input = document.querySelector('#tagify-categories');
    var tagify = new Tagify(input, {
        whitelist: {!! json_encode($categories->pluck('title')->toArray()) !!},
        enforceWhitelist: true,
        autoComplete: true,
        editTags: 1,
        duplicate: false,
        maxTags: Infinity,
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
    });

    tagify.on('invalid', function(e) {
        console.log(e.detail);
    });
</script>


        </div>
    </div>
</div>


<!-- Tags -->
<div class="card mb-3">
    <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left no-link-decoration collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Tags
            </button>
        </h2>
    </div>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="card-body">
            
        <input name="tags" id="tagify-tags" placeholder="Enter tags" value="{{ implode(',', $post->tags->pluck('title')->toArray()) }}">

<script>
    var input = document.querySelector('#tagify-tags');
    var tagify = new Tagify(input, {
        whitelist: {!! json_encode($tags->pluck('title')->toArray()) !!},
        enforceWhitelist: true,
        autoComplete: true,
        editTags: 1,
        duplicate: false,
        maxTags: Infinity,
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
    });

    tagify.on('invalid', function(e) {
        console.log(e.detail);
    });
</script>

        </div>
    </div>
            </div>


<!-- Post Image Card -->
<div class="card mb-3">
    <div class="card-header" id="headingFour">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed no-link-decoration" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Post image
            </button>
        </h2>
    </div>
    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
        <div class="card-body">
            <div class="input-group">
                <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image" value="{{ $post->image }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                </div>
            </div>
            <!-- Aquí está el nuevo elemento de imagen -->
            <div id="image-preview" style="position: relative; max-width: 100%;">
                <img id="image-preview-img" src="{{ $post->image }}" alt="Image preview" style="display: inline; max-width: 100%;">
                <button id="remove-image" style="display: inline; position: absolute; top: 0; right: 0;">X</button>
            </div>
        </div>
    </div>
</div>
<!-- End Post Image Card -->




</form>

</div> <!-- End col md3 -->

    </div>

</div>


@include('laraflex::admin.partials.posts-filemanager-modal-scripts')
@include('laraflex::admin.partials.posts-ckeditor-conf')

<!-- Start btn set-home-post JS -->

<script>
$(document).ready(function() {
    $('#set-home-page').click(function(event) {
        event.preventDefault(); // Añade esta línea si el botón está dentro de un <form>

        var postId = {{ $post->id }};

        $.ajax({
            type: 'POST',
            url: '{{ route('setHomePost', '') }}/' + postId,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                // Mostrar el mensaje de éxito solo una vez
                alert("The post has been set as the front page");

                // Cambiar el estado del botón
                $('#set-home-page').prop('disabled', true).removeClass('btn-secondary').addClass('btn-primary').text('This is the front paget');
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText;
                alert("Error: " + errorMessage);
            }
        });
    });
});
</script>



@endsection




