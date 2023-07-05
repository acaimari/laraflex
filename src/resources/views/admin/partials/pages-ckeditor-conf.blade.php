<!----------CKeditor JS------------------->
<script>
    CKEDITOR.replace('ckeditorcontent', {
        removePlugins: 'exportpdf',
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'monokai_sublime',
        filebrowserImageBrowseUrl: '/fmanager-modal-adv?source=ckeditor',
        toolbar: 'Full',
        labels: {
            CodeSnippet: 'Code Snippet' 
        },
        height: 600 // Ajusta la altura deseada aquí
    });
</script>
