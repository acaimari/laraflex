
<script>
CKEDITOR.replace('postcontent', {
    height: 400,
    extraPlugins: 'codesnippet',
    codeSnippet_theme: 'monokai_sublime',
    filebrowserImageBrowseUrl: '/fmanager-modal-adv?source=ckeditor',
    removeButtons: 'Save,Print',
    toolbarGroups: [
        { name: 'document', groups: ['mode', 'document', 'doctools'] },
        { name: 'clipboard', groups: ['clipboard', 'undo'] },
        { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'customGroup', groups: ['codesnippetGroup'], order: 9 } // Agregar grupo personalizado
    ],
    toolbar: [
        { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
        { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
        { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
        { name: 'styles', items: ['Styles', 'Format'] },
        { name: 'colors', items: ['TextColor', 'BGColor'] },
        { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
        '/',
        { name: 'customGroup', items: ['CodeSnippet'] } // Agregar botón personalizado
    ],
    // Establecer etiquetas personalizadas
    labels: {
        CodeSnippet: 'Code Snippet' // Cambiar el nombre del botón Code Snippet
    }
});

</script>
