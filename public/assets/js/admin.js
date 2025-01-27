setTimeout(() => {
    if (!tinymce.get('content-editor')) {
        tinymce.init({
            selector: '.content-editor',
            language: 'ru',
            license: 'gpl',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            toolbar: 'code',
        });
    }
}, 1000);
