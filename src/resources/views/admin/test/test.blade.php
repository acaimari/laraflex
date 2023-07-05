

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="far fa-file-alt"></i> Test Page</h1>
    <ol class="breadcrumb mb-4"></ol>

    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/plugins/codesnippet/plugin.js') }}"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
<link href="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') }}" rel="stylesheet">

<!--
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/config.js') }}"></script>
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/styles.js') }}"></script>
<script src="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/build-config.js') }}"></script> -->

<!--
<link rel="stylesheet" href="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/contents.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/caimari/laraflex/assets/vendor/ckeditor/skins/moonocolor/editor.css') }}">
-->
<!-- <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script> -->

<script>
    CKEDITOR.replace('editor1', {
        removePlugins: 'exportpdf',
        extraPlugins: 'codesnippet',
        toolbar: 'Full',
        labels: {
            CodeSnippet: 'Code Snippet' // Cambiar el nombre del botón Code Snippet
        }
    });
</script>


