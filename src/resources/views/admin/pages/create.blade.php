@extends('laraflex::layouts.admin')
@section('content')


<style>
    .div-con-margen {
        margin: 132px;
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
        <h1 class="mt-4">
    <span><i class="mdi mdi-format-page-break"></i><h2 class="d-inline"> Create Page</h2></span>
        </h1>

            <ol class="breadcrumb mb-4"></ol>

        <form action="{{ route('pages.store') }}" method="POST">
                @csrf
         

        <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" required>
      </div>


      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <!-- Ckeditor -->
        <textarea class="form-control" id="ckeditorcontent" name="content" rows="4"></textarea>
      </div>


       </div>  <!-- End Left column -->
        
<!----------------------------------------------------------------------------------->


        <div class="col-md-3"> <!-- Right column -->

<!----------------- Cards ---------------------------->

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
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>


            <div class="margin"></div>

            <div class="mb-3">
                <label for="sidebar_position" class="form-label">View format (Sidebar)</label>
                <select class="form-control" id="sidebar_position" name="sidebar_position">
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                    <option value="none">None</option>
                </select>

                <div class="margin"></div>

                <button type="submit" class="btn btn-primary">Save</button>
                
            </div>
        </div>
    </div>
</div>



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
    <div class="input-group">
        <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image" value="">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
        </div>
    </div>

    <div id="image-preview" style="position: relative; max-width: 100%;">
        <img id="image-preview-img" alt="Image preview" style="display: none; max-width: 100%;"> <!-- Initially hide the img element -->
        <button id="remove-image" style="display: none; position: absolute; top: 0; right: 0;">X</button> <!-- Initially hide the remove button -->
    </div>
</div>

<!-- End Page Image Card -->

 


</form>

</div> <!-- End col md3 -->

    </div>

</div>


<!-- Fmanager Modal -->
<div class="modal fade" id="fileManagerModal" tabindex="-1" role="dialog" aria-labelledby="fileManagerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileManagerModalLabel">File Manager</h5>
        <button type="button" class="btn-close" aria-label="Close" id="closeModalButton"></button>
      </div>
      <div class="modal-body">
        <!-- Aquí va el iframe que contendrá el File Manager -->
        <iframe id="fileManagerIframe" src="/fmanager-modal-adv" width="100%" height="600px"></iframe>
      </div>
    </div>
  </div>
</div>

		<!-- JS input and preview image with FManager -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Image select handler.
    document.getElementById('button-image').addEventListener('click', (event) => {
        event.preventDefault();
        // Opens the modal
        $('#fileManagerModal').modal('show');
    });

    // Add image removal handler.
    document.getElementById('remove-image').addEventListener('click', (event) => {
        event.preventDefault();
        removeImage();
    });

    // Handler for message event
    window.addEventListener('message', function(event) {
        if (event.data.fileUrl) {
            console.log('URL del archivo seleccionado:', event.data.fileUrl);
            // Sustituye 'public' por 'storage' en la URL del archivo
            var fileUrl = event.data.fileUrl.replace('public', 'storage');
            // Concatena la URL del host con la URL del archivo
            var fullUrl = window.location.protocol + "//" + window.location.host + fileUrl;
            console.log('URL completa del archivo seleccionado:', fullUrl);
            // Establece la URL del archivo en el campo de entrada
            document.getElementById('image_label').value = fileUrl; // Cambiado a fileUrl
            // Establece la URL de la imagen en la etiqueta img y muestra la imagen.
            fmSetLink(fullUrl);
            // Cierra el modal
            $('#fileManagerModal').modal('hide');
        }
    });

    // La función que se invoca cuando se selecciona una imagen.
function fmSetLink(fullUrl) {
    const url = new URL(fullUrl);
    const pathname = url.pathname;

    // Establece la URL de la imagen en el campo de entrada y muestra la imagen.
    document.getElementById('image_label').value = pathname;
    var img = document.getElementById('image-preview-img');
    img.src = fullUrl;
    img.style.display = 'block'; // Show the img element

    // Muestra el botón de eliminar.
    document.getElementById('remove-image').style.display = 'block'; // Show the remove button

    // Almacena la URL de la imagen en localStorage.
    localStorage.setItem('image-url', fullUrl);
}

// New function to check image
function checkImage() {
    var imgLabelValue = document.getElementById('image_label').value;
    if (imgLabelValue != '') {
        var fullUrl = window.location.protocol + "//" + window.location.host + imgLabelValue;
        document.getElementById('image-preview-img').src = fullUrl;
        document.getElementById('image-preview-img').style.display = 'block';
        document.getElementById('remove-image').style.display = 'block';
    }
}

// Call checkImage on page load
document.addEventListener("DOMContentLoaded", function() {
    checkImage();
    // Limpia el campo de entrada de la imagen.
    document.getElementById('image_label').value = '';
});

// Remove image function.
function removeImage() {
    // Elimina la URL de la imagen del localStorage.
    localStorage.removeItem('image-url');

    // Limpia el campo de entrada de la imagen.
    document.getElementById('image_label').value = '';

    // Oculta la imagen.
    var img = document.getElementById('image-preview-img');
    img.style.display = 'none';

    // Oculta el botón de eliminar.
    document.getElementById('remove-image').style.display = 'none';
}

});
</script>


@include('laraflex::admin.partials.pages-ckeditor-conf')


<!-- Slug -->
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
