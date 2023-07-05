@extends('laraflex::layouts.admin')

@section('content')

<style>
    .div-con-margen {
        margin: 32px;
    }

    @media (max-width: 767px) {
        /* Estilos para pantallas con un ancho máximo de 767px */
        .div-con-margen {
            margin: 0;
        }
    }
</style>

<style>
.codeblock {
    background-color: black;
    color: white;
    padding: 10px;
    border-radius: 5px;
    font-family: 'Courier New', Courier, monospace;
}

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
<h1 class="mt-4">
    <span><i class="mdi mdi-format-page-break"></i><h2 class="d-inline"> Edit Page</h2></span>
        </h1>

    <ol class="breadcrumb mb-4"></ol>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-9">
            <form action="{{ route('pages.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" required>
                </div>

               
    <div class="mb-3">
        <label for="pagecontent" class="form-label">Content</label>
        <!--- Content CKeditor -->
        <textarea cols="80" id="ckeditorcontent" name="content" rows="10">{{ $page->content }}</textarea>
    </div>

        <div class="margin"></div>

            <button id="set-home-page" class="btn{{ $isHomePage ? ' btn-primary' : ' btn-secondary' }}" {{ $isHomePage ? 'disabled' : '' }}>
    @if ($isHomePage)
        This is the home page
    @else
        Set as home page
    @endif
</button>

    <div class="margin"></div>

        </div>


        
 <!-----------------------------COL M3 ---------------------------------------------------------------->

     <div class="col-md-3">
                <!-- Contenido de la segunda columna M3 -->

                <div class="div-con-margen">
    <!-- Contenido del div con margen -->
</div>
<!-- Publish Card -->
<div class="card mb-3">
    <div class="card-header" id="headingZero">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left no-link-decoration collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
            <span>
             <i class="mdi mdi-publish"></i> Publish
            </span>
            </button>
        </h2>
    </div>

    <div id="collapseZero" class="collapse show" aria-labelledby="headingZero" data-bs-parent="#accordionExample">
        <div class="card-body">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>

            <div class="margin"></div>

            <div class="mb-3">
                <label for="sidebar_position" class="form-label">View format (Sidebar)</label>
                <select class="form-control" id="sidebar_position" name="sidebar_position">
                    <option value="left" {{ $page->sidebar_position == 'left' ? 'selected' : '' }}>Left</option>
                    <option value="right" {{ $page->sidebar_position == 'right' ? 'selected' : '' }}>Right</option>
                    <option value="none" {{ $page->sidebar_position == 'none' ? 'selected' : '' }}>None</option>
                </select>

                <div class="margin"></div>

                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-outline"></i> Save
                    </button>
                    <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-success">
                        <i class="mdi mdi-eye-arrow-right-outline"></i> View
                    </a>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-exit-run"></i> Exit
                    </a>
                </div>




            </div>
        </div>
    </div>
</div>

<!-- End Publish Card -->


<!-- Page Image Card -->
<div class="card mb-3">
    <div class="card-header" id="headingFour">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed no-link-decoration" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <span>
             <i class="mdi mdi-image-outline"></i> Page header image
            </span>
            </button>
        </h2>
    </div>
    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
  
  
    <div class="card-body">

    <!-- Upload input image -->
    <div class="input-group">

        <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image" value="{{ $page->image }}">
        
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
        </div>
        
    </div>


    <!-- Aquí está el nuevo elemento de imagen -->
    <div id="image-preview" style="position: relative; max-width: 100%;">
        <img id="image-preview-img" src="{{ $page->image }}" alt="Image preview" style="display: inline; max-width: 100%;">
  <button id="remove-image" style="display: inline; position: absolute; top: 0; right: 0;">X</button>
    </div>
</div>
<!-- End Page Image Card -->

<!--------------------------->
</form> <!-- End Form -->
</div> <!-- End md3 -->

@include('laraflex::admin.partials.pages-filemanager-modal-scripts')
@include('laraflex::admin.partials.pages-ckeditor-conf')

<script>
$(document).ready(function() {
    $('#set-home-page').click(function(event) {
        event.preventDefault(); // Añade esta línea si el botón está dentro de un <form>

        var pageId = {{ $page->id }};

        $.ajax({
            type: 'POST',
            url: '{{ route('setHomePage', '') }}/' + pageId,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                // Mostrar el mensaje de éxito solo una vez
                alert("The page has been set as the front page");

                // Cambiar el estado del botón
                $('#set-home-page').prop('disabled', true).removeClass('btn-secondary').addClass('btn-primary').text('This is the front page');
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

