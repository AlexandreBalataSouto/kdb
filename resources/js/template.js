require('./bootstrap');

$(".boxGifLoading").css("display", "none");

$("button[type='submit']").click(function (e) {
    $(".boxGifLoading").css("display", "flex");
});

//Para iniciar las funciones de materialize
document.addEventListener('DOMContentLoaded', function () {
    let modals = document.querySelectorAll('.modal');
    var instances = M.Modal.init(modals, {
        dismissible: false,
    });

    let sidenav = document.querySelectorAll('.sidenav');
    instances = M.Sidenav.init(sidenav);

    let dropdowns = document.querySelectorAll('.dropdown-trigger');
    instances = M.Dropdown.init(dropdowns);

    let tooltips = document.querySelectorAll('.tooltipped');
    instances = M.Tooltip.init(tooltips);
});

//Configuracion de dropzone
Dropzone.options.dropzoneForm = {
    maxFiles: 4,
    acceptedFiles: "image/jpeg,image/png,image/jpg",
    dictDefaultMessage: "Suba sus archivos aqui",
    dictMaxFilesExceeded: "Ha excedido el numero de archivos",
    dictInvalidFileType: "No puedes subir este tipo de imagen. Solo .jpeg/.png/.jpg",

    init: function () {
        myDropzone = this;
        var submitButton = document.querySelector("#botonSubirArchivo");
        submitButton.addEventListener("click", function () {//Limpiar dropzone
            if (myDropzone.getQueuedFiles().length == 0 && myDropzone.getUploadingFiles().length == 0) {
                myDropzone.removeAllFiles();
                $("#botonSubirArchivo").hide();
                $(".closeModal").show();
            }
        });
        this.on("addedfiles", function () { //Funcion para cuando se suben archivos
            $(".closeModal").hide();
        });
        this.on("complete", function () {//Funcion para cuando se terminan de subir los archivos
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                $("#botonSubirArchivo").show();
            }
        });
    },
};

window.fotoPreVisual = function (input) { //Previsualizar foto en creacion de fichas
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#fotoFormCreate").attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

M.updateTextFields(); //Actualizar text fields

window.toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

