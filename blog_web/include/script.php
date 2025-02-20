<script src="assets/quill.min.js"></script>
    
<script src="assets/quill.min.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    var form = document.querySelector('form');
    var hiddenTextarea = document.getElementById('hidden-description');

    form.onsubmit = function() {
        // Set the value of the hidden textarea to the Quill editor's HTML
        hiddenTextarea.value = quill.root.innerHTML;
    };
</script>