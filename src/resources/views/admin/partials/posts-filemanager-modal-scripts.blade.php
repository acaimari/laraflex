
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

    // Check for image on post load.
    checkImage();
    
    // Handler for message event
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
        document.getElementById('image_label').value = pathname; // Esto guardará solo la ruta relativa
        var img = document.getElementById('image-preview-img');
        img.src = fullUrl;
        img.style.display = 'block';

        // Muestra el botón de eliminar.
        document.getElementById('remove-image').style.display = 'block';

        // Almacena la URL de la imagen en el almacenamiento local.
        localStorage.setItem('imageForPost{{ $post->id }}', pathname);
    }

    // Function to remove image.
    function removeImage() {
        document.getElementById('image_label').value = '';
        var img = document.getElementById('image-preview-img');
        img.src = '';
        img.style.display = 'none';

        // Hide the remove button.
        document.getElementById('remove-image').style.display = 'none';

        // Remove image URL from local storage.
        localStorage.removeItem('imageForPost{{ $post->id }}');
    }

// Function to check for an image on start.

    function checkImage() {
        var img = document.getElementById('image-preview-img');
        var url = img.src;
        if (url.includes('http') && url != window.location.href) {
            // If there's an image, show the remove button.
            document.getElementById('remove-image').style.display = 'block';
        } else {
            // If there's no image, hide the remove button.
            document.getElementById('remove-image').style.display = 'none';
        }

    // Check if there's a saved image URL in local storage.
    var savedUrl = localStorage.getItem('imageForPost{{ $post->id }}');
        if (savedUrl) {
            var fullSavedUrl = window.location.protocol + "//" + window.location.host + "/" + savedUrl;
            img.src = fullSavedUrl;
            img.style.display = 'block';
            document.getElementById('image_label').value = savedUrl; // Cambiado a savedUrl
            document.getElementById('remove-image').style.display = 'block';
        }
    }
// Close modal when close button is clicked
document.getElementById('closeModalButton').addEventListener('click', function() {
      $('#fileManagerModal').modal('hide');
    });
  });
</script>
