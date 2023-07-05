@extends('laraflex::layouts.admin')
@section('content')

<style>
    .image-item {
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        display: inline-block;
        margin-right: 10px;
    }

    .image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    
    .delete-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #ff0000;
        color: #ffffff;
        border: none;
        width: 20px;
        height: 20px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container-fluid px-4">
<h1 class="mt-4">
    <span><i class="mdi mdi-view-gallery"></i><h2 class="d-inline"> Edit Gallery</h2></span>
        </h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $gallery->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $gallery->description }}</textarea>
        </div>

        <!-- Gallery Images Section -->
        <div class="mb-3">
            <h2>Gallery Images</h2>
            <div id="images-container" class="sortable">
                @if ($gallery->images)
                    @foreach ($gallery->images as $image)
                        <div class="image-item" data-id="{{ $image->id }}">
                            <img src="{{ $image->url }}" />
                            <input type="hidden" name="images[]" value="{{ $image->url }}" />
                            <button class="delete-button" type="button" onclick="deleteImage(this)">&times;</button>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="d-flex justify-content-start gap-2">
            <button class="btn btn-outline-secondary" type="button" id="button-image">Select Images</button>
            <button type="submit" class="btn btn-primary">Update Gallery</button>
            </div>

        </div>
 
    </form>
</div>

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


<!-- Sorteable-->
<script src="https://cdn.jsdelivr.net/gh/SortableJS/Sortable@1.10.2/Sortable.min.js"></script>


<!-- File Manager JS Multiple images -->
<script>

    let isAddingToGallery = false;

    document.addEventListener("DOMContentLoaded", function() {
        // Inicializar Sortable.
        new Sortable(document.getElementById('images-container'), {
            // Opciones aquí.
        });

        // Manejador de selección de imagen.
        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();
            // Cuando el botón de imagen es presionado, establece isAddingToGallery a true
            isAddingToGallery = true;
            $('#fileManagerModal').modal('show');
        });

         // Cuando el modal se cierra, restablece isAddingToGallery a false
         $('#fileManagerModal').on('hidden.bs.modal', function () {
            isAddingToGallery = false;
        });
    });


    // Función de retorno de llamada desde el administrador de archivos para manejar las imágenes seleccionadas.
    function fmSetLink(url) {
        // Crear un nuevo elemento de imagen.
        var item = document.createElement('div');
        item.className = 'image-item';
        // Como no tenemos un ID de archivo, solo lo dejaremos vacío.
        item.dataset.id = '';

        // Añadir imagen y entrada oculta al elemento.
        item.innerHTML = `
            <img src="${url}" />
            <input type="hidden" name="images[]" value="${url}" />
            <button class="delete-button" type="button" onclick="deleteImage(this)">&times;</button>
        `;

        // Anexar el elemento al contenedor.
        document.getElementById('images-container').appendChild(item);
    }

    // Función para eliminar una imagen del contenedor.
    function deleteImage(button) {
        var imageItem = button.parentNode;
        imageItem.parentNode.removeChild(imageItem);
    }
// Handler for message event

window.addEventListener('message', function(event) {
  // Comprueba si hay una URL de archivo.
  if (event.data.fileUrl) {
    console.log('URL de archivo seleccionada:', event.data.fileUrl);

    var filePath = event.data.fileUrl;

    // Concatena la URL del host con la URL del archivo.
    // Asegúrate de no tener una barra inclinada al final de window.location.host y al inicio de filePath.
    var fullUrl = window.location.protocol + "//" + window.location.host + filePath;
    console.log('URL completa del archivo seleccionado:', fullUrl);

    // Crea un nuevo elemento de imagen y añádelo al contenedor.
    fmSetLink(fullUrl);

    // Cierra el modal.
    $('#fileManagerModal').modal('hide');
  }
});

    // Manejador para cerrar el modal.
        document.getElementById('closeModalButton').addEventListener('click', () => {
        $('#fileManagerModal').modal('hide');
});


</script>


@endsection
