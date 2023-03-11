jQuery(document).ready(function ($){
    const metaBoxTextArea = document.querySelector("#editor");
    let metaBoxContent    = document.querySelector('#cj-content');
    let metaBoxLanguage   = document.querySelector('#cj-language');

    const languages = {
        "css" :  "css",
        "js" :   "javascript",
        "html" : "xml",
    }

    const params = new URLSearchParams(window.location.search);
    let language = params.get('language');

    if (language != null){
        metaBoxLanguage.value = language;
    }else {
        language = metaBoxLanguage.value;
    }

    if (metaBoxTextArea) {
        const editor = CodeMirror.fromTextArea(
            metaBoxTextArea,{
                mode : languages[language],
                lineNumbers: true,
                lineWrapping: true,
                tabSize: 4,
                indentUnit: 4,
                theme: '3024-night',
                autoCloseTags: true
            }
        )

        editor.on('change', function() {
            let content = editor.getValue();
            metaBoxContent.value = content;
        });
    }

});

