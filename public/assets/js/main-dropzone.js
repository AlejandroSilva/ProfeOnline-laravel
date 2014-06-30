document.addEventListener("DOMContentLoaded", function() {

    // Get the template HTML and remove it from the document
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);


    window.myDropzone = new Dropzone(
        document.body, // Make the whole body a dropzone
        {
            url: "http://localhost/ProfeOnline-laravel/public/upload/", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".btn-agregar", // Define the element that should be used as click trigger to select files.
            maxFilesize: 2, // 2Mb de tamaño maximo de los arhivos (cada uno)
            dictFileTooBig: "Este archivo es muy grande (maximo {{maxFilesize}}Mb). No se adjuntara a la publicación."
        }
    );


    // Actualiza la barra de cargar total
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });

    // Muestra la barra de carga general
    myDropzone.on("sending", function(file) {
        document.querySelector("#total-progress").style.opacity = "1";
    });

    // Oculta la barra de carga total cuando no queda nada mas que enviar
    myDropzone.on("queuecomplete", function(progress) {
        console.log("queuecomplete-laravel");
        // si llego por un archivo con error (tamaño maximo), ignorar y no hacer nada
        if(myDropzone.getFilesWithStatus(Dropzone.ERROR).length==0)
            publicacion_terminada();
    });
});